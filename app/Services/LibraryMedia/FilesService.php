<?php

namespace App\Services\LibraryMedia;

class FilesService
{
    public function injectJavascriptInView(): void
    {
        share([
            'libraryMedia' => [
                'clipboardCopy' => [
                    'route' => route('libraryMedia.file.clipboardContent', ['__ID__', '__TYPE__', '__LOCALE__']),
                ],
            ],
        ]);
    }
}
