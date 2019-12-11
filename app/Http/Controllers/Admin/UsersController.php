<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use App\Services\Users\UsersService;
use Artesaos\SEOTools\Facades\SEOTools;
use Auth;
use ErrorException;
use Exception;
use Hash;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class UsersController extends Controller
{
    /**
     * @return Factory|View
     * @throws ErrorException
     * @throws BindingResolutionException
     */
    public function index()
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Users')]));
        $table = (new UsersService)->table();

        return view('templates.admin.users.index', compact('table'));
    }

    /**
     * @return Factory|View
     * @throws Exception
     */
    public function create()
    {
        $user = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Users')]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param UserStoreRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(UserStoreRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user = (new User)->create($request->validated());
        (new UsersService)->manageAvatarFromRequest($request, $user);

        return redirect()->route('users.index')->with('toast_success', __('notifications.orphan.created', [
            'entity' => __('Users'),
            'name'   => $user->name,
        ]));
    }

    /**
     * @param User $user
     *
     * @return Factory|View
     * @throws Exception
     */
    public function edit(User $user)
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->name]));

        return view('templates.admin.users.edit', compact('user'));
    }

    /**
     * @param User $user
     * @param UserUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        if ($request->new_password) {
            $request->merge(['password' => Hash::make($request->new_password)]);
        }
        $user->update($request->validated());
        (new UsersService)->manageAvatarFromRequest($request, $user);

        return back()->with('toast_success', $user->id === Auth::id()
            ? __('notifications.name.updated', ['name' => __('My profile')])
            : __('notifications.orphan.updated', [
                'entity' => __('Users'),
                'name'   => $user->name,
            ]));
    }

    /**
     * @param User $user
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Users'),
            'name'   => $name,
        ]));
    }

    /**
     * @return Factory|View
     * @throws Exception
     */
    public function profile()
    {
        $user = auth()->user();
        SEOTools::setTitle(__('My profile'));

        return view('templates.admin.users.edit', compact('user'));
    }
}
