<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\LibraryMediaFilesIndexRequest;
use App\Http\Requests\LibraryMedia\LibraryMediaFileStoreRequest;
use App\Http\Requests\LibraryMedia\LibraryMediaFileUpdateRequest;
use App\Models\LibraryMedia\LibraryMediaFile;
use App\Services\LibraryMedia\FilesService;
use App\Tables\LibraryMediaFilesTable;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;

class LibraryMediaFilesController extends Controller
{
    /**
     * @param \App\Http\Requests\LibraryMedia\LibraryMediaFilesIndexRequest $request
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     * @throws \Exception
     */
    public function index(LibraryMediaFilesIndexRequest $request): View
    {
        $table = (new LibraryMediaFilesTable($request))->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Media library'),
            'entity' => __('Files'),
        ]));
        app(FilesService::class)->injectJavascriptInView();
        $js = mix('/js/templates/admin/library-media/edit.js');

        return view('templates.admin.library-media.files.index', compact('table', 'request', 'js'));
    }

    public function create(): View
    {
        $file = null;
        SEOTools::setTitle(__('breadcrumbs.orphan.create', ['entity' => __('Media library')]));

        return view('templates.admin.library-media.files.edit', compact('file'));
    }

    /**
     * @param \App\Http\Requests\LibraryMedia\LibraryMediaFileStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(LibraryMediaFileStoreRequest $request): RedirectResponse
    {
        $file = LibraryMediaFile::create($request->validated());
        $file->addMediaFromRequest('media')->toMediaCollection('media');

        return redirect()->route('libraryMedia.files.index')
            ->with('toast_success', __('crud.orphan.created', [
                'entity' => __('Media library'),
                'name' => $file->name,
            ]));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaFile $file
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function edit(LibraryMediaFile $file): View
    {
        SEOTools::setTitle(__('breadcrumbs.orphan.edit', [
            'entity' => __('Media library'),
            'detail' => $file->name,
        ]));
        app(FilesService::class)->injectJavascriptInView();
        $js = mix('/js/templates/admin/library-media/edit.js');

        return view('templates.admin.library-media.files.edit', compact('file', 'js'));
    }

    /**
     * @param \App\Models\LibraryMedia\LibraryMediaFile $file
     * @param \App\Http\Requests\LibraryMedia\LibraryMediaFileUpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(LibraryMediaFileUpdateRequest $request, LibraryMediaFile $file): RedirectResponse
    {
        $file->update($request->validated());
        if ($request->file('media')) {
            $file->addMediaFromRequest('media')->toMediaCollection('media');
        }

        return back()->with('toast_success', __('crud.orphan.updated', [
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
        $file->delete();

        return back()->with('toast_success', __('crud.orphan.destroyed', [
            'entity' => __('Media library'),
            'name' => $file->name,
        ]));
    }

    public function clipboardContent(LibraryMediaFile $file, string $type, ?string $locale = null): JsonResponse
    {
        $media = $file->getFirstMedia('media');
        if (! $media) {
            $returnCode = Response::HTTP_NOT_FOUND;
            $clipboardContent = null;
            $message = __('Not media has been attached to this file.');

            return response()->json(compact('clipboardContent', 'message'), $returnCode);
        }
        $locale = $locale ?: app()->getLocale();
        switch ($type) {
            case 'url':
                $returnCode = Response::HTTP_OK;
                $clipboardContent = $file->getFirstMedia('media')->getFullUrl();
                $message = __('Clipboard copy: :name - :type.', [
                    'name' => $file->getTranslation('name', $locale),
                    'type' => __('URL'),
                ]);
                break;
            case 'display':
                if (! $file->can_be_displayed_on_page) {
                    $returnCode = Response::HTTP_NOT_FOUND;
                    $clipboardContent = null;
                    $message = __('This type of media can\'t be displayed.');
                    break;
                }
                $returnCode = Response::HTTP_OK;
                $clipboardContent = trim(view(
                    'components.admin.library-media.clipboard-copy.display-html',
                    compact('file', 'media', 'locale')
                )->toHtml());
                $message = __('Clipboard copy: :name - :type.', [
                    'name' => $file->getTranslation('name', $locale),
                    'type' => __('HTML Display'),
                ]);
                break;
            case 'download':
                $returnCode = Response::HTTP_OK;
                $clipboardContent = trim(view(
                    'components.admin.library-media.clipboard-copy.download-html',
                    compact('file', 'media', 'locale')
                )->toHtml());
                $message = __('Clipboard copy: :name - :type.', [
                    'name' => $file->getTranslation('name', $locale),
                    'type' => __('HTML Download'),
                ]);
                break;
            default:
                $returnCode = Response::HTTP_BAD_REQUEST;
                $clipboardContent = null;
                $message = __('An unexpected error occurred. If the problem persists, please contact support.');
        }

        return response()->json(compact('clipboardContent', 'message'), $returnCode);
    }
}
