<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PageAccessTest extends TestCase
{
    use DatabaseMigrations;

    public function testHomeAccess()
    {
        $this->withoutMix();
        $this->artisan('db:seed --class=SettingsSeeder');
        $this->artisan('db:seed --class=HomePageSeeder');
        $this->artisan('db:seed --class=PagesSeeder');
        $this->get('/')->assertStatus(200);
    }
}
