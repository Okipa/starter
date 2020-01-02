<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Http\Requests\Utils\DownloadFileRequest;

class DownloadController extends Controller
{
    /**
     * @param \App\Http\Requests\Utils\DownloadFileRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function file(DownloadFileRequest $request)
    {
        if (file_exists($request->path)) {
            return response()->download($request->path, $request->name);
        }
        alert()->html(__('The file: file does not exist.', [
            'file' => $request->path,
        ]), 'error', __('Error'))->showConfirmButton();

        return redirect()->route('home');
    }
}
