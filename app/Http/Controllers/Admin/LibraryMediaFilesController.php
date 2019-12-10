<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryMedia\FilesIndexRequest;
use App\Http\Requests\LibraryMedia\FileStoreRequest;
use App\Http\Requests\LibraryMedia\FileUpdateRequest;
use App\Models\LibraryMediaFile;
use App\Services\LibraryMedia\FilesService;
use Artesaos\SEOTools\Facades\SEOTools;
use ErrorException;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Log;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class LibraryMediaFilesController extends Controller
{
    /**
     * @param FilesIndexRequest $request
     *
     * @return Factory|View
     * @throws ErrorException
     * @throws BindingResolutionException
     */
    public function index(FilesIndexRequest $request)
    {
        $table = (new FilesService)->table($request);
        SEOTools::setTitle(__('admin.title.orphan.index', ['entity' => __('entities.libraryMedia')]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/index.js');

        return view('templates.admin.libraryMedia.files.index', compact('table', 'request', 'js'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $file = null;
        SEOTools::setTitle(__('admin.title.orphan.create', ['entity' => __('entities.libraryMedia')]));

        return view('templates.admin.libraryMedia.files.edit', compact('file'));
    }

    /**
     * @param FileStoreRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(FileStoreRequest $request)
    {
        /** @var LibraryMediaFile $file */
        $file = (new LibraryMediaFile)->create($request->validated());
        $uploadedMediaFile = $request->file('media');
        $fileName = Str::slug($request->name) . '.' . $uploadedMediaFile->getClientOriginalExtension();
        $file->addMedia($uploadedMediaFile->getRealPath())
            ->setName($request->name)
            ->setFileName($fileName)
            ->toMediaCollection('medias');

        return redirect()->route('libraryMedia.files.index')
            ->with('toast_success', __('notifications.message.crud.orphan.created', [
                'entity' => __('entities.libraryMedia'),
                'name'   => $file->name,
            ]));
    }

    /**
     * @param LibraryMediaFile $file
     *
     * @return Factory|View
     * @throws Exception
     */
    public function edit(LibraryMediaFile $file)
    {
        SEOTools::setTitle(__('admin.title.orphan.edit', [
            'entity' => __('entities.libraryMedia'),
            'detail' => $file->name,
        ]));
        (new FilesService)->injectJavascriptInView();
        $js = mix('/js/library-media/edit.js');

        return view('templates.admin.libraryMedia.files.edit', compact('file', 'js'));
    }

    /**
     * @param LibraryMediaFile $file
     * @param FileUpdateRequest $request
     *
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(LibraryMediaFile $file, FileUpdateRequest $request)
    {
        $file->update($request->validated());
        if ($request->file('media')) {
            $uploadedMediaFile = $request->file('media');
            $fileName = Str::slug($request->name) . '.' . $uploadedMediaFile->getClientOriginalExtension();
            $file->addMedia($uploadedMediaFile->getRealPath())
                ->setName($request->name)
                ->setFileName($fileName)
                ->toMediaCollection('medias');
        }

        return back()->with('toast_success', __('notifications.message.crud.orphan.updated', [
            'entity' => __('entities.libraryMedia'),
            'name'   => $file->name,
        ]));
    }

    /**
     * @param LibraryMediaFile $file
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(LibraryMediaFile $file)
    {
        $name = $file->name;
        $file->delete();

        return back()->with('toast_success', __('notifications.message.crud.orphan.destroyed', [
            'entity' => __('entities.libraryMedia'),
            'name'   => $name,
        ]));
    }

    /**
     * @param LibraryMediaFile $file
     * @param string $type
     *
     * @return JsonResponse
     */
    public function clipboardContent(LibraryMediaFile $file, string $type)
    {
        try {
            $clipboardContent = $type === 'url'
                ? $file->getFirstMedia('medias')->getFullUrl()
                : trim(view('components.admin.table.library-media.html-clipboard-content', compact('file'))->toHtml());
            $message = __('library-media.notifications.clipboardCopy.success', [
                'type' => strtoupper($type),
                'name' => $file->name,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            $message = __('notifications.message.exception.support');
        }

        return response()->json(compact('clipboardContent', 'message'));
    }
}
