<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\FilesIndexRequest;
use App\Http\Requests\LibraryMedia\FileStoreRequest;
use App\Http\Requests\LibraryMedia\FileUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaFile;
use App\Services\LibraryMedia\FilesService;
use App\Tables\LibraryMediaFilesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Log;

class LibraryMediaFilesController extends Controller
{
    /**
     * @param \App\Http\Requests\LibraryMedia\FilesIndexRequest $request
     *
     * @return \Illuminate\View\View
     * @throws \ErrorException
     */
    public function index(FilesIndexRequest $request): View
    {
        $table = (new LibraryMediaFilesTable($request))->setup();
        SEOTools::setTitle(__('breadcrumbs.orphan.index', ['entity' => __('Media library')]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/index.js');

        return view('templates.admin.libraryMedia.files.index', compact('table', 'request', 'js'));
    }

    public function create(): View
    {
        $file = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Media library')]));

        return view('templates.admin.libraryMedia.files.edit', compact('file'));
    }

    /**
     * @param \App\Http\Requests\LibraryMedia\FileStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(FileStoreRequest $request): RedirectResponse
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
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function edit(LibraryMediaFile $file): View
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
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(LibraryMediaFile $file, FileUpdateRequest $request): RedirectResponse
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
    public function destroy(LibraryMediaFile $file): RedirectResponse
    {
        $name = $file->name;
        $file->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => __('Media library'),
            'name' => $name,
        ]));
    }

    public function clipboardContent(LibraryMediaFile $file, string $type, ?string $locale = null): JsonResponse
    {
        try {
            $locale = $locale ?: app()->getLocale();
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
