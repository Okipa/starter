<?php

namespace App\Tables;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class LibraryMediaFilesTable extends AbstractTable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table)->model(LibraryMediaFile::class)
            ->routes([
                'index' => ['name' => 'libraryMedia.files.index'],
                'create' => ['name' => 'libraryMedia.file.create'],
                'edit' => ['name' => 'libraryMedia.file.edit'],
                'destroy' => ['name' => 'libraryMedia.file.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(fn(LibraryMediaFile $file) => [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Media library'),
                    'name' => $file->name,
                ]),
            ])
            ->query(function (Builder $query) {
                $query->select('library_media_files.*');
                $query->addSelect(multilingual()
                    ? 'library_media_categories.name->' . app()->getLocale() . ' as category_name'
                    : 'library_media_categories.name as category_name');
                $query->addSelect('media.mime_type');
                $query->join('media', 'media.model_id', '=', 'library_media_files.id');
                $query->join(
                    'library_media_categories',
                    'library_media_categories.id',
                    '=',
                    'library_media_files.category_id'
                );
                $query->where('model_type', 'App\Models\LibraryMedia\LibraryMediaFile');
                if ($this->request->has('category_id')) {
                    $query->where('library_media_categories.id', $this->request->category_id);
                }
            })
            ->appendData($this->request->validated());
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('thumb')
            ->html(fn(LibraryMediaFile $file) => view('components.admin.table.library-media.thumb', compact('file')));
        $table->column('name')->value(fn(LibraryMediaFile $file) => $file->name)->sortable()->searchable();
        $table->column('category_name')
            ->link(fn(LibraryMediaFile $file) => route('libraryMedia.files.index', [
                'category_id' => $file->category->id,
            ]))
            ->value(fn(LibraryMediaFile $file) => $file->category->name)
            ->sortable();
        $table->column('mime_type')
            ->title(__('MIME types'))
            ->html(fn(LibraryMediaFile $file) => '<a class="new-window" '
                . 'href="https://slick.pl/kb/htaccess/complete-list-mime-types">'
                . $file->getFirstMedia('medias')->mime_type . '</a>')
            ->sortable()
            ->searchable('media');
        $table->column()->title(__('Clipboard copy'))->html(fn(LibraryMediaFile $file) => view(
            'components.admin.table.library-media.clipboard-copy.buttons',
            compact('file')
        ));
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
    }
}
