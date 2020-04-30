<?php

namespace App\Tables;

use App\Models\Users\User;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class UsersTable extends AbstractTable
{
    /**
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table)->model(User::class)->routes([
            'index' => ['name' => 'users.index'],
            'create' => ['name' => 'user.create'],
            'edit' => ['name' => 'user.edit'],
            'destroy' => ['name' => 'user.destroy'],
        ])->disableRows(function (User $user) {
            return $user->id === auth()->id();
        })->destroyConfirmationHtmlAttributes(function (User $user) {
            return [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Users'),
                    'name' => $user->name,
                ]),
            ];
        });
    }

    /**
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('thumb')->html(function (User $user) {
            return view('components.admin.table.image', ['image' => $user->getFirstMedia('avatars')]);
        });
        $table->column('first_name')->sortable(true)->searchable();
        $table->column('last_name')->sortable()->searchable();
        $table->column('email')->sortable()->searchable();
    }
}
