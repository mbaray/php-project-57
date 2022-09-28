<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    public function testWelcomePage(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }
}
