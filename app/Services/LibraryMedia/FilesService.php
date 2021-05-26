<?php

namespace App\Services\LibraryMedia;

class FilesService
{
    public function injectJavascriptInView(): void
    {
        share([
            'libraryMedia' => [
                'clipboardCopy' => [
                    // Todo: remove `__LOCALE__` if your app is not multilingual.
                    'route' => route('libraryMedia.file.clipboardContent', ['__ID__', '__TYPE__', '__LOCALE__']),
                ],
            ],
        ]);
    }
}
