<?php

namespace App\Services\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaFile;
use App\Services\Service;
use Illuminate\Http\Request;
use JavaScript;
use Okipa\LaravelTable\Table;

class FilesService extends Service implements FilesServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(Request $request): Table
    {
        $table = (new Table)->model(LibraryMediaFile::class)->routes([
            'index' => ['name' => 'libraryMedia.files.index'],
            'create' => ['name' => 'libraryMedia.file.create'],
            'edit' => ['name' => 'libraryMedia.file.edit'],
            'destroy' => ['name' => 'libraryMedia.file.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (LibraryMediaFile $file) {
            return [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Media library'),
                    'name' => $file->name,
                ]),
            ];
        })->query(function ($query) use ($request) {
            $query->select('library_media_files.*');
            $query->addSelect('library_media_categories.name->' . app()->getLocale() . ' as category_name');
            $query->addSelect('media.mime_type');
            $query->join('media', 'media.model_id', '=', 'library_media_files.id');
            $query->join(
                'library_media_categories',
                'library_media_categories.id',
                '=',
                'library_media_files.category_id'
            );
            $query->where('model_type', 'App\Models\LibraryMedia\LibraryMediaFile');
            if ($request->has('category_id')) {
                $query->where('library_media_categories.id', $request->category_id);
            }
        })->appends($request->validated());
        $table->column('thumb')->html(function (LibraryMediaFile $file) {
            return view('components.admin.table.library-media.thumb', compact('file'));
        });
        $table->column('name')->value(function (LibraryMediaFile $file) {
            return $file->name;
        })->sortable()->searchable();
        $table->column('category_name')->sortable()->searchable('library_media_categories', ['name']);
        $table->column('mime_type')
            ->title(__('MIME types'))
            ->html(function (LibraryMediaFile $file) {
                return '<a class="new-window" href="https://slick.pl/kb/htaccess/complete-list-mime-types">'
                    . $file->getFirstMedia('medias')->mime_type
                    . '</a>';
            })
            ->sortable()
            ->searchable('media');
        $table->column('downloadable')->html(function (LibraryMediaFile $file) {
            return $file->downloadable && $file->canBeDisplayed
                ? '<i class="fas fa-check text-success"></i>'
                : '<i class="fas fa-times text-danger"></i>';
        })->sortable();
        $table->column()->title(__('Clipboard copy'))->html(function (LibraryMediaFile $file) {
            return view('components.admin.table.library-media.copy-clipboard-buttons', compact('file'));
        });
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();

        return $table;
    }

    /**
     * Inject javascript in the current view.
     *
     * @return void
     */
    public function injectJavascriptInView(): void
    {
        JavaScript::put([
            'libraryMedia' => [
                'clipboardCopy' => [
                    'route' => route('libraryMedia.file.clipboardContent', ['__ID__', '__TYPE__', '__LOCALE__']),
                ],
            ],
        ]);
    }
}
