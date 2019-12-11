<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\HomeSlidesReorganizeRequest;
use App\Http\Requests\Home\HomeSlidesStoreRequest;
use App\Http\Requests\Home\HomeSlidesUpdateRequest;
use App\Models\HomePage;
use App\Models\HomeSlide;
use App\Services\Home\HomeSlidesService;
use Artesaos\SEOTools\Facades\SEOTools;
use ErrorException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use JavaScript;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class HomeSlidesController extends Controller
{
    /**
     * @return View
     * @throws ErrorException
     * @throws BindingResolutionException
     */
    public function index(): View
    {
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Home'),
            'entity' => __('Slides'),
        ]));
        $table = (new HomeSlidesService)->table();
        Javascript::put([
            'slides' => [
                'route' => [
                    'reorganize' => route('home.slides.reorganize'),
                ],
            ],
        ]);
        $js = mix('/js/home/slides/index.js');

        return view('templates.admin.home.slides.index', compact('table', 'js'));
    }

    /**
     * @param HomePage $homePage
     *
     * @return Factory|View
     */
    public function create(HomePage $homePage)
    {
        $homeSlide = null;

        return view(
            'templates.admin.home.slides.edit',
            compact('homePage', 'homeSlide')
        );
    }

    /**
     * @param HomeSlidesStoreRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(HomeSlidesStoreRequest $request)
    {
        /** @var HomePage $homePage */
        $homePage = (new HomePage)->firstOrFail();
        /** @var HomeSlide $slide */
        $slide = (new HomeSlide)->create(array_merge($request->validated(), ['home_page_id' => $homePage->id]));
        if ($request->file('illustration')) {
            $slide->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }

        return redirect()->route('home.slides.index')
            ->with('toast_success', __('notifications.parent.created', [
                'parent' => __('Home'),
                'entity' => __('Slides'),
                'name'   => $slide->title,
            ]));
    }

    /**
     * @param HomePage $homePage
     * @param HomeSlide $homeSlide
     *
     * @return Factory|View
     */
    public function edit(HomePage $homePage, HomeSlide $homeSlide)
    {
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => __('Home'),
            'entity' => __('Slides'),
            'detail' => $homeSlide->title,
        ]));

        return view(
            'templates.admin.home.slides.edit',
            compact('homePage', 'homeSlide')
        );
    }

    /**
     * @param HomeSlide $homeSlide
     * @param HomeSlidesUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(HomeSlide $homeSlide, HomeSlidesUpdateRequest $request)
    {
        $homeSlide->update($request->validated());
        if ($request->file('illustration')) {
            $homeSlide->addMediaFromRequest('illustration')->toMediaCollection('illustrations');
        }

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => __('Home'),
            'entity' => __('Slides'),
            'name'   => $homeSlide->title,
        ]));
    }

    /**
     * @param HomeSlide $homeSlide
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(HomeSlide $homeSlide)
    {
        $homePage = $homeSlide->homePage;
        $name = $homeSlide->title;
        $homeSlide->delete();
        $orderedIds = (new HomeSlide)->where('home_page_id', $homePage->id)->ordered()->pluck('id');
        (new HomeSlide)->setNewOrder($orderedIds);

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => __('Home'),
            'entity' => __('Slides'),
            'name'   => $name,
        ]));
    }

    /**
     * @param HomeSlidesReorganizeRequest $request
     *
     * @return ResponseFactory|Response
     */
    public function reorganize(HomeSlidesReorganizeRequest $request)
    {
        (new HomeSlide)->setNewOrder($request->ordered_ids);

        return response(['message' => __('The list has been reorganized.')], 200);
    }
}
