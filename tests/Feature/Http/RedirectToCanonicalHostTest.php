<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectToCanonicalHostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => 'https://www.updaz.fr']);
    }

    public function testBareDomainIsPermanentlyRedirectedToCanonicalHostKeepingPathAndQuery(): void
    {
        $response = $this->get('https://updaz.fr/application-web-bordeaux?page=2');

        $response->assertStatus(301);
        $response->assertRedirect('https://www.updaz.fr/application-web-bordeaux?page=2');
    }

    public function testCanonicalHostIsServedWithoutRedirect(): void
    {
        $response = $this->get('https://www.updaz.fr/');

        $response->assertOk();
    }
}
