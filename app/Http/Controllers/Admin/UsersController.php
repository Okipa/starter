<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Users\User;
use App\Services\Users\UsersService;
use App\Tables\UsersTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Users')]));
        $table = app(UsersTable::class)->setup();

        return view('templates.admin.users.index', compact('table'));
    }

    public function create(): View
    {
        $user = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Users')]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param \App\Http\Requests\Users\UserStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create(array_merge(
            $request->validated(),
            ['password' => Hash::make($request->password ?: Str::random(8))]
        ));
        app(UsersService::class)->saveProfilePictureFromRequest($request, $user);
        $additionalMessage = '';
        if (! $request->password) {
            $user->sendWelcomeNotification(now()->addMinutes(120));
            $additionalMessage = ' ' . __('A password creation link has been sent.');
        }

        return redirect()->route('users.index')->with('toast_success', __('notifications.orphan.created', [
                'entity' => __('Users'),
                'name' => $user->full_name,
            ]) . $additionalMessage);
    }

    public function edit(User $user): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->full_name]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param \App\Models\Users\User $user
     * @param \App\Http\Requests\Users\UserUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(User $user, UserUpdateRequest $request): RedirectResponse
    {
        $user->update($request->validated()['new_password']
            ? array_merge($request->validated(), ['password' => Hash::make($request->validated()['new_password'])])
            : Arr::except($request->validated(), 'password'));
        app(UsersService::class)->saveProfilePictureFromRequest($request, $user);

        return back()->with('toast_success', $user->id === Auth::id()
            ? __('notifications.name.updated', ['name' => __('Profile')])
            : __('notifications.orphan.updated', [
                'entity' => __('Users'),
                'name' => $user->full_name,
            ]));
    }

    /**
     * @param \App\Models\Users\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Users'),
            'name' => $user->full_name,
        ]));
    }
}
