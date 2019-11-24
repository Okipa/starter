<?php

namespace App\Services\MediaLibrary;

use App\Models\LibraryMedia;
use App\Models\NewsArticle;
use App\Services\Service;
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
                    'name'   => $libraryMedia->getFirstMedia('medias')->name,
                ]),
            ];
        });
        $table->column('thumb')->html(function (LibraryMedia $libraryMedia) {
            return view('components.admin.table.image', ['image' => $libraryMedia->getFirstMedia('medias')]);
        });
        $table->column('name')->sortable()->value(function (LibraryMedia $libraryMedia) {
            return $libraryMedia->name;
        });
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true);

        return $table;
    }
}
