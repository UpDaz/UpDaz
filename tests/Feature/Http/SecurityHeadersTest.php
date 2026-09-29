<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => 'https://www.updaz.fr']);
    }

    public function testSecurityHeadersAreSentOnPages(): void
    {
        $response = $this->get('https://www.updaz.fr/mentions-legales');

        $response->assertOk();
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    }

    public function testHstsIsNotSentOverHttp(): void
    {
        $response = $this->get('http://www.updaz.fr/mentions-legales');

        $response->assertHeaderMissing('Strict-Transport-Security');
    }
}
