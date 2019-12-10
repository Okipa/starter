<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Http\Requests\Utils\DownloadFileRequest;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    /**
     * @param DownloadFileRequest $request
     *
     * @return RedirectResponse|BinaryFileResponse
     */
    public function file(DownloadFileRequest $request)
    {
        if (file_exists($request->path)) {
            return response()->download($request->path, $request->name);
        }
        alert()->html(__('notifications.message.downloadFile.doesNotExist', [
            'file' => $request->path,
        ]), 'error', __('Error'))->showConfirmButton();

        return redirect()->route('home');
    }
}
