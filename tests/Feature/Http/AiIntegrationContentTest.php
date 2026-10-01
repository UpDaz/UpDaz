<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiIntegrationContentTest extends TestCase
{
    use RefreshDatabase;

    public function testLaravelPagePresentsAiIntegration(): void
    {
        $response = $this->get(route('laravel'));

        $response->assertOk();
        $response->assertSee('id="integration-ia"', false);
        $response->assertSee(route('category', ['slug' => 'intelligence-artificielle']), false);
    }

    public function testHomePageListsArtificialIntelligenceAmongSkills(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSeeInOrder(['Intelligence artificielle', 'Data / Analytics']);
    }
}
