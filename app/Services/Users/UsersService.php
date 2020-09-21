<?php

namespace App\Services\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;

class UsersService
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Users\User $user
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function saveAvatarFromRequest(Request $request, User $user): void
    {
        if ($request->file('profile_picture')) {
            $user->addMediaFromRequest('profile_picture')->toMediaCollection('profile_pictures');
        } elseif ($request->method() !== 'PUT' || $request->remove_avatar) {
            $this->setDefaultAvatar($user);
        }
    }

    /**
     * @param \App\Models\Users\User $user
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function setDefaultAvatar(User $user): void
    {
        $user->addMedia(database_path('seeders/files/users/default-450-450.png'))
            ->preservingOriginal()
            ->toMediaCollection('profile_pictures');
    }
}
