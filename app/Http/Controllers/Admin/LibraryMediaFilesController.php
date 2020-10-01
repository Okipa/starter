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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LibraryMediaFilesController extends Controller
{
    /**
     * @param \App\Http\Requests\LibraryMedia\FilesIndexRequest $request
     *
     * @return \Illuminate\View\View
     * @throws \ErrorException
     * @throws \Exception
     */
    public function index(FilesIndexRequest $request): View
    {
        $table = (new LibraryMediaFilesTable($request))->setup();
        SEOTools::setTitle(__('breadcrumbs.parent.index', [
            'parent' => __('Media library'),
            'entity' => __('Files'),
        ]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/templates/admin/library-media/index.js');

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
        $file = LibraryMediaFile::create($request->validated());
        $file->addMediaFromRequest('media')->toMediaCollection('media');

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
        $js = mix('/js/templates/admin/library-media/edit.js');

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
            $file->addMediaFromRequest('media')->toMediaCollection('media');
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
        $file->delete();

        return back()->with('toast_success', __('notifications.orphan.destroyed', [
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
                    'type' => __('URL'),
                    'name' => $file->getTranslation('name', $locale),
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
                    'type' => __('HTML Display'),
                    'name' => $file->getTranslation('name', $locale),
                ]);
                break;
            case 'download':
                $returnCode = Response::HTTP_OK;
                $clipboardContent = trim(view(
                    'components.admin.library-media.clipboard-copy.download-html',
                    compact('file', 'media', 'locale')
                )->toHtml());
                $message = __('Clipboard copy: :name - :type.', [
                    'type' => __('HTML Download'),
                    'name' => $file->getTranslation('name', $locale),
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
