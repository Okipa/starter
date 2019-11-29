<?php

namespace App\Services\MediaLibrary;

use App\Models\LibraryMedia;
use App\Services\Service;
use JavaScript;
use Okipa\LaravelTable\Table;

class LibraryMediaService extends Service implements LibraryMediaServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(LibraryMedia::class)->routes([
            'index'   => ['name' => 'libraryMedia.index'],
            'create'  => ['name' => 'libraryMedia.create'],
            'edit'    => ['name' => 'libraryMedia.edit'],
            'destroy' => ['name' => 'libraryMedia.destroy'],
        ])->destroyConfirmationHtmlAttributes(function (LibraryMedia $libraryMedia) {
            return [
                'data-confirm' => __('notifications.message.crud.orphan.destroyConfirm', [
                    'entity' => __('entities.libraryMedia'),
                    'name'   => $libraryMedia->name,
                ]),
            ];
        })->query(function ($query) {
            $query->select('library_media.*');
            $query->addSelect('media.mime_type');
            $query->join('media', 'media.model_id', '=', 'library_media.id');
            $query->where('model_type', 'App\Models\LibraryMedia');
        });
        $table->column('thumb')->html(function (LibraryMedia $libraryMedia) {
            return view('components.admin.table.library-media.thumb', compact('libraryMedia'));
        });
        $table->column('name')->value(function (LibraryMedia $libraryMedia) {
            return $libraryMedia->name;
        })->sortable()->searchable();
        $table->column('mime_type')
            ->title(__('library-media.labels.mime_type'))
            ->html(function (LibraryMedia $libraryMedia) {
                return '<a class="new-window" href="https://slick.pl/kb/htaccess/complete-list-mime-types">'
                    . $libraryMedia->getFirstMedia('medias')->mime_type
                    . '</a>';
            })
            ->sortable()
            ->searchable('media');
        $table->column('downloadable')->html(function (LibraryMedia $libraryMedia) {
            return $libraryMedia->downloadable && $libraryMedia->canBeDisplayed
                ? '<i class="fas fa-check text-success"></i>'
                : '<i class="fas fa-times text-danger"></i>';
        })->sortable();
        $table->column()->title(__('library-media.labels.clipboardCopy'))->html(function (LibraryMedia $libraryMedia) {
            return view('components.admin.table.library-media.copy-clipboard-buttons', compact('libraryMedia'));
        });
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();

        return $table;
    }

    /**
     * Inject javascript in the current view.
     */
    public function injectJavascriptInView(): void
    {
        JavaScript::put([
            'libraryMedia' => [
                'clipboardCopy' => [
                    'route' => route('libraryMedia.clipboardContent', ['__ID__', '__TYPE__']),
                ],
            ],
        ]);
    }
}
