<?php

namespace App\Services\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UsersService
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Users\User $user
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function saveProfilePictureFromRequest(Request $request, User $user): void
    {
        $file = $request->remove_profile_picture ? null : $request->file('profile_picture');
        $this->saveAvatarFromUploadedFile($file, $user);
    }

    /**
     * @param \Illuminate\Http\UploadedFile|null $file
     * @param \App\Models\Users\User $user
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function saveAvatarFromUploadedFile(?UploadedFile $file, User $user)
    {
        if ($file) {
            $user->addMedia($file)->toMediaCollection('profile_pictures');
        } else {
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
