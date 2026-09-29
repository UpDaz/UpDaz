<?php

namespace Tests\Feature\Http;

use App\Http\Middleware\RedirectToCanonicalHost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function testHttpBareDomainWithTrailingSlashIsRedirectedInASingleHop(): void
    {
        $response = $this->get('http://updaz.fr/articles/?page=2');

        $response->assertStatus(301);
        $response->assertRedirect('https://www.updaz.fr/articles?page=2');
    }

    public function testHttpCanonicalHostIsRedirectedToHttps(): void
    {
        $response = $this->get('http://www.updaz.fr/application-web-bordeaux');

        $response->assertStatus(301);
        $response->assertRedirect('https://www.updaz.fr/application-web-bordeaux');
    }

    public function testTrailingSlashIsRemoved(): void
    {
        $response = (new RedirectToCanonicalHost())->handle(
            Request::create('https://www.updaz.fr/articles/?page=2'),
            fn (): Response => new Response('should not be reached')
        );

        $this->assertSame(301, $response->getStatusCode());
        $this->assertSame('https://www.updaz.fr/articles?page=2', $response->headers->get('Location'));
    }
}
