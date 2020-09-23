<?php

namespace App\Tables;

use App\Models\Users\User;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class UsersTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table)->model(User::class)
            ->routes([
                'index' => ['name' => 'users.index'],
                'create' => ['name' => 'user.create'],
                'edit' => ['name' => 'user.edit'],
                'destroy' => ['name' => 'user.destroy'],
            ])
            ->disableRows(fn(User $user) => $user->id === auth()->id())
            ->destroyConfirmationHtmlAttributes(fn(User $user) => [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Users'),
                    'name' => $user->full_name,
                ]),
            ]);
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
        $table->column('id')->sortable();
        $table->column('thumb')->html(function (User $user) {
            return view('components.admin.media.thumb', ['image' => $user->getFirstMedia('profile_pictures')]);
        });
        $table->column('first_name')->stringLimit(25)->sortable()->searchable();
        $table->column('last_name')->stringLimit(25)->sortable()->searchable();
        $table->column('email')->stringLimit(25)->sortable()->searchable();
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
