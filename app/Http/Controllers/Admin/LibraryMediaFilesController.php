<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\FilesIndexRequest;
use App\Http\Requests\LibraryMedia\FileStoreRequest;
use App\Http\Requests\LibraryMedia\FileUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaFile;
use App\Services\LibraryMedia\FilesService;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Log;

class LibraryMediaFilesController extends Controller
{
    /**
     * @param \App\Http\Requests\LibraryMedia\FilesIndexRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ErrorException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(FilesIndexRequest $request)
    {
        $table = (new FilesService)->table($request);
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Media library')]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/index.js');

        return view('templates.admin.libraryMedia.files.index', compact('table', 'request', 'js'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $file = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Media library')]));

        return view('templates.admin.libraryMedia.files.edit', compact('file'));
    }

    /**
     * @param \App\Http\Requests\LibraryMedia\FileStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(FileStoreRequest $request)
    {
        /** @var \App\Models\LibraryMedia\LibraryMediaFile $file */
        $file = (new LibraryMediaFile)->create($request->validated());
        $file->addMediaFromRequest('media')->toMediaCollection('medias');

        return redirect()->route('libraryMedia.files.index')
            ->with('toast_success', __('notifications.orphan.created', [
                'entity' => __('Media library'),
                'name' => $file->name,
            ]));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaFile $file
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(LibraryMediaFile $file)
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Media library'),
            'detail' => $file->name,
        ]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/edit.js');

        return view('templates.admin.libraryMedia.files.edit', compact('file', 'js'));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaFile $file
     * @param \App\Http\Requests\LibraryMedia\FileUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(LibraryMediaFile $file, FileUpdateRequest $request)
    {
        $file->update($request->validated());
        if ($request->file('media')) {
            $file->addMediaFromRequest('media')->toMediaCollection('medias');
        }

        return back()->with('toast_success', __('notifications.orphan.updated', [
            'entity' => __('Media library'),
            'name' => $file->name,
        ]));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaFile $file
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(LibraryMediaFile $file)
    {
        $name = $file->name;
        $file->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Media library'),
            'name' => $name,
        ]));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaFile $file
     * @param string $type
     * @param string|null $locale
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clipboardContent(LibraryMediaFile $file, string $type, ?string $locale)
    {
        try {
            $clipboardContent = $type === 'url'
                ? $file->getFirstMedia('medias')->getFullUrl()
                : trim(view(
                    'components.admin.table.library-media.html-clipboard-content',
                    compact('file', 'locale')
                )->toHtml());
            $message = __('Media « :name » :type copied in clipboard.', [
                'type' => strtoupper($type),
                'name' => $file->getTranslation('name', $locale),
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            $clipboardContent = null;
            $message = __('An unexpected error occurred. If the problem persists, please contact support.');
        }

        return response()->json(compact('clipboardContent', 'message'));
    }
}
