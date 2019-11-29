<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\LibraryMediaStoreRequest;
use App\Http\Requests\News\LibraryMediaUpdateRequest;
use App\Models\LibraryMedia;
use App\Services\MediaLibrary\LibraryMediaService;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Support\Str;
use JavaScript;
use Log;

class LibraryMediaController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $table = (new LibraryMediaService)->table();
        SEOTools::setTitle(__('admin.title.orphan.index', ['entity' => __('entities.libraryMedia')]));
        (new LibraryMediaService)->injectJavascriptInView();
        $js = mix('/js/library-media/index.js');

        return view('templates.admin.libraryMedia.index', compact('table', 'js'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $libraryMedia = null;
        SEOTools::setTitle(__('admin.title.orphan.create', ['entity' => __('entities.libraryMedia')]));

        return view('templates.admin.libraryMedia.edit', compact('libraryMedia'));
    }

    /**
     * @param \App\Http\Requests\LibraryMedia\LibraryMediaStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(LibraryMediaStoreRequest $request)
    {
        /** @var LibraryMedia $libraryMedia */
        $libraryMedia = (new LibraryMedia)->create($request->validated());
        $uploadedMediaFile = $request->file('media');
        if ($uploadedMediaFile) {
            $fileName = Str::slug($request->name) . '.' . $uploadedMediaFile->getClientOriginalExtension();
            $libraryMedia->addMedia($uploadedMediaFile->getRealPath())
                ->setName($request->name)
                ->setFileName($fileName)
                ->toMediaCollection('medias');
        }

        return redirect()->route('libraryMedia.index')
            ->with('toast_success', __('notifications.message.crud.orphan.created', [
                'entity' => __('entities.libraryMedia'),
                'name'   => $libraryMedia->name,
            ]));
    }

    /**
     * @param \App\Models\LibraryMedia $libraryMedia
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(LibraryMedia $libraryMedia)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('entities.libraryMedia'),
            'detail' => $libraryMedia->title,
        ]));
        (new LibraryMediaService)->injectJavascriptInView();
        $js = mix('/js/library-media/edit.js');

        return view('templates.admin.libraryMedia.edit', compact('libraryMedia', 'js'));
    }

    /**
     * @param \App\Models\LibraryMedia $libraryMedia
     * @param \App\Http\Requests\News\LibraryMediaUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(LibraryMedia $libraryMedia, LibraryMediaUpdateRequest $request)
    {
        $libraryMedia->update($request->validated());
        if ($request->file('media')) {
            $libraryMedia->addMediaFromRequest('media')->toMediaCollection('medias');
        }

        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('entities.libraryMedia'),
            'name'   => $libraryMedia->title,
        ]));
    }

    /**
     * @param \App\Models\LibraryMedia $libraryMedia
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(LibraryMedia $libraryMedia)
    {
        $name = $libraryMedia->name;
        $libraryMedia->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('entities.libraryMedia'),
            'name'   => $name,
        ]));
    }

    /**
     * @param \App\Models\LibraryMedia $libraryMedia
     * @param string $type
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clipboardContent(LibraryMedia $libraryMedia, string $type)
    {
        try {
            $clipboardContent = $type === 'url'
                ? $libraryMedia->getFirstMedia('medias')->getFullUrl()
                : trim(view(
                    'components.admin.table.library-media.html-clipboard-content',
                    compact('libraryMedia')
                )->toHtml());
            $message = __('library-media.notifications.clipboardCopy.success', [
                'type' => strtoupper($type),
                'name' => $libraryMedia->name,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            $message = __('notifications.message.exception.support');
        }

        return response()->json(compact('clipboardContent', 'message'));
    }
}
