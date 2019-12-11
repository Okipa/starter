<?php

namespace App\Services\Users;

use App\Http\Requests\Request;
use App\Models\User;
use App\Services\Service;
use ErrorException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Okipa\LaravelTable\Table;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class UsersService extends Service implements UsersServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return Table
     * @throws ErrorException
     * @throws BindingResolutionException
     */
    public function table(): Table
    {
        $table = (new Table)->model(User::class)->routes([
            'index' => ['name' => 'users'],
            'create' => ['name' => 'user.create'],
            'edit' => ['name' => 'user.edit'],
            'destroy' => ['name' => 'user.destroy'],
        ])->disableRows(function (User $user) {
            return $user->id === auth()->id();
        })->destroyConfirmationHtmlAttributes(function (User $user) {
            return [
                'data-confirm' => __('notifications.orphan.destroyConfirm', [
                    'entity' => __('Settings'),
                    'name' => $user->name,
                ]),
            ];
        });
        $table->column('thumb')->html(function (User $user) {
            return view('components.admin.table.image', ['image' => $user->getFirstMedia('avatars')]);
        });
        $table->column('first_name')->sortable(true)->searchable();
        $table->column('last_name')->sortable()->searchable();
        $table->column('email')->sortable()->searchable();

        return $table;
    }

    /**
     * Manage avatar from request.
     *
     * @param Request $request
     * @param User $user
     *
     * @return void
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function manageAvatarFromRequest(Request $request, User $user): void
    {
        if ($request->file('avatar')) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        } elseif ($request->method() !== 'PUT' || $request->remove_avatar) {
            $this->setDefaultAvatarImage($user);
        }
    }

    /**
     * Set default avatar image for the given user.
     *
     * @param User $user
     *
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setDefaultAvatarImage(User $user): void
    {
        $user->addMedia(database_path('seeds/files/users/default-450-450.png'))
            ->preservingOriginal()
            ->toMediaCollection('avatars');
    }
}
