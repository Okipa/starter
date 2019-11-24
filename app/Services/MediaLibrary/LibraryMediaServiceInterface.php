<?php

namespace App\Services\MediaLibrary;

use App\Services\ServiceInterface;
use Okipa\LaravelTable\Table;

interface LibraryMediaServiceInterface extends ServiceInterface
{
    /**
     * Generate the media table list.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    public function table(): Table;
}
