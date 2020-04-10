<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Users\User;
use App\Services\Users\UsersService;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Users')]));
        $table = (new UsersService)->table();

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
        /** @var \App\Models\Users\User $user */
        $user = (new User)->create(array_merge(
            $request->validated(),
            ['password' => Hash::make($request->password ?: Str::random(8))]
        ));
        (new UsersService)->saveAvatarFromRequest($request, $user);
        $additionalMessage = '';
        if (! $request->password) {
            $user->sendWelcomeNotification(now()->addMinutes(120));
            $additionalMessage = ' ' . __('A password creation link has been sent.');
        }

        return redirect()->route('users.index')->with('toast_success', __('notifications.orphan.created', [
                'entity' => __('Users'),
                'name' => $user->name,
            ]) . $additionalMessage);
    }

    public function edit(User $user): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->name]));

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
        if ($request->new_password) {
            $request->merge(['password' => Hash::make($request->new_password)]);
        }
        $user->update($request->validated());
        (new UsersService)->saveAvatarFromRequest($request, $user);

        return back()->with('toast_success', $user->id === Auth::id()
            ? __('notifications.name.updated', ['name' => __('My profile')])
            : __('notifications.orphan.updated', [
                'entity' => __('Users'),
                'name' => $user->name,
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
        $name = $user->name;
        $user->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Users'),
            'name' => $name,
        ]));
    }

    public function profile(): View
    {
        $user = auth()->user();
        SEOTools::setTitle(__('My profile'));

        return view('templates.admin.users.edit', compact('user'));
    }
}
