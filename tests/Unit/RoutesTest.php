<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    /** @test */
    public function it_can_execute_route_list_command(): void
    {
        $this->artisan('route:list')->assertExitCode(0);
    }
}
