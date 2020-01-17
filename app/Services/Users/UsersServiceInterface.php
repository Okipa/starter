<?php

namespace App\Services\Users;

use App\Http\Requests\Request;
use App\Models\Users\User;
use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface UsersServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function table(): Table;

    /**
     * Save avatar from request.
     *
     * @param \App\Http\Requests\Request $request
     * @param \App\Models\Users\User $user
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function saveAvatarFromRequest(Request $request, User $user): void;

    /**
     * Set default avatar image for the given user.
     *
     * @param \App\Models\Users\User $user
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function setDefaultAvatar(User $user): void;
}
