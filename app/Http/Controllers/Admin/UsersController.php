<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use App\Services\Users\UsersService;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use Hash;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Users')]));
        $table = (new UsersService)->table();

        return view('templates.admin.users.index', compact('table'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Users')]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param \App\Http\Requests\Users\UserStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(UserStoreRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user = (new User)->create($request->validated());
        (new UsersService)->saveAvatarFromRequest($request, $user);

        return redirect()->route('users.index')->with('toast_success', __('notifications.orphan.created', [
            'entity' => __('Users'),
            'name' => $user->name,
        ]));
    }

    /**
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->name]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param \App\Models\User $user
     * @param \App\Http\Requests\Users\UserUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(User $user, UserUpdateRequest $request)
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
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Users'),
            'name' => $name,
        ]));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $user = auth()->user();
        SEOTools::setTitle(__('My profile'));

        return view('templates.admin.users.edit', compact('user'));
    }
}
