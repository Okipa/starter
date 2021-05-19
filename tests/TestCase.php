<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        // We store files in a testing directory.
        Storage::fake('local');
        // We config spatie/laravel-medialibrary to store files in testing directory.
        config()->set('media-library.disk_name', 'local');
    }
}
