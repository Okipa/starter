<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cookies\CookieServicesIndexRequest;
use App\Http\Requests\Cookies\CookieServiceStoreRequest;
use App\Http\Requests\Cookies\CookieServiceUpdateRequest;
use App\Models\Cookies\CookieService;
use App\Tables\CookieServicesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CookieServicesController extends Controller
{
    /**
     * @param \App\Http\Requests\Cookies\CookieServicesIndexRequest $request
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     */
    public function index(CookieServicesIndexRequest $request): View
    {
        $table = app(CookieServicesTable::class, compact('request'))->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Cookies'),
            'entity' => __('Services'),
        ]));

        return view('templates.admin.cookies.services.index', compact('table', 'request'));
    }

    public function create(): View
    {
        $cookieService = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => __('Cookies'),
            'entity' => __('Services'),
        ]));

        return view('templates.admin.cookies.services.edit', compact('cookieService'));
    }

    /**
     * @param \App\Http\Requests\Cookies\CookieServiceStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CookieServiceStoreRequest $request): RedirectResponse
    {
        $cookieService = CookieService::create($request->validated());
        cookieCategories(true);

        return redirect()->route('cookie.services.index')
            ->with('toast_success', __('crud.parent.created', [
                'parent' => __('Cookies'),
                'entity' => __('Services'),
                'name' => $cookieService->title,
            ]));
    }

    public function edit(CookieService $cookieService): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Cookies'),
            'entity' => __('Services'),
            'detail' => $cookieService->title,
        ]));

        return view('templates.admin.cookies.services.edit', compact('cookieService'));
    }

    /**
     * @param \App\Http\Requests\Cookies\CookieServiceUpdateRequest $request
     * @param \App\Models\Cookies\CookieService $cookieService
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(CookieServiceUpdateRequest $request, CookieService $cookieService): RedirectResponse
    {
        $cookieService->update($request->validated());
        cookieCategories(true);

        return back()->with('toast_success', __('crud.parent.updated', [
            'parent' => __('Cookies'),
            'entity' => __('Services'),
            'name' => $cookieService->title,
        ]));
    }

    /**
     * @param \App\Models\Cookies\CookieService $cookieService
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(CookieService $cookieService): RedirectResponse
    {
        $cookieService->delete();
        cookieCategories(true);

        return back()->with('toast_success', __('crud.parent.destroyed', [
            'parent' => __('Cookies'),
            'entity' => __('Services'),
            'name' => $cookieService->title,
        ]));
    }
}
