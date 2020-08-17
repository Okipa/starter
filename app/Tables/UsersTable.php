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
        return (new Table)->model(User::class)->routes([
            'index' => ['name' => 'users.index'],
            'create' => ['name' => 'user.create'],
            'show' => ['name' => 'user.edit'],
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
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->sortable(true);
        $table->column('thumb')->html(function (User $user) {
            return view('components.admin.table.thumb', ['image' => $user->getFirstMedia('profile_pictures')]);
        });
        $table->column('first_name')->sortable()->searchable();
        $table->column('last_name')->sortable()->searchable();
        $table->column('email')->sortable()->searchable();
        $table->column('email_verified_at')
            ->title(__('Verified email'))
            ->sortable()
            ->html(fn(User $user) => view('components.admin.table.bool', ['active' => $user->email_verified_at]));
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable();
    }

    /**
     * Configure the table result lines.
     *
     * @param \Okipa\LaravelTable\Table $table
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function resultLines(Table $table): void
    {
        $table->result()
            ->title(__('Total of users with unverified email'))
            ->html(fn() => (new User)->where('email_verified_at', null)->count());
    }
}
