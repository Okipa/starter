<?php

namespace App\Services\Users;

use App\Http\Requests\Request;
use App\Models\User;
use App\Services\ServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Okipa\LaravelTable\Table;

interface UsersServiceInterface extends ServiceInterface
{
    /**
     * Configure the model table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table;

    /**
     * Manage avatar from request.
     *
     * @param \App\Http\Requests\Request $request
     * @param \App\Models\User $user
     *
     * @return void
     */
    public function manageAvatarFromRequest(Request $request, User $user): void;

    /**
     * Set default avatar image for the given user.
     *
     * @param \App\Models\User $user
     */
    public function setDefaultAvatarImage(User $user): void;
}
