<?php

namespace Tests\Feature\Services;

use App\Services\RemoteImageInspector;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RemoteImageInspectorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['blog.max_image_kilobytes' => 300]);
    }

    public function testAcceptsALightImage(): void
    {
        Http::fake(['*' => Http::response('', 200, ['Content-Type' => 'image/webp', 'Content-Length' => 120 * 1024])]);

        $this->assertTrue((new RemoteImageInspector())->isEmbeddable('https://example.com/light.webp'));
    }

    public function testRejectsAnImageHeavierThanTheCap(): void
    {
        Http::fake(['*' => Http::response('', 200, ['Content-Type' => 'image/png', 'Content-Length' => 2 * 1024 * 1024])]);

        $this->assertFalse((new RemoteImageInspector())->isEmbeddable('https://example.com/heavy.png'));
    }

    public function testRejectsAnUnreachableImage(): void
    {
        Http::fake(['*' => Http::response('', 403)]);

        $this->assertFalse((new RemoteImageInspector())->isEmbeddable('https://example.com/forbidden.png'));
    }

    public function testRejectsAResponseThatIsNotAnImage(): void
    {
        Http::fake(['*' => Http::response('', 200, ['Content-Type' => 'text/html', 'Content-Length' => 1024])]);

        $this->assertFalse((new RemoteImageInspector())->isEmbeddable('https://example.com/page'));
    }

    public function testFallsBackToARangedRequestWhenTheHeadHasNoLength(): void
    {
        Http::fake(function ($request) {
            if ($request->method() === 'HEAD') {
                return Http::response('', 200, ['Content-Type' => 'image/jpeg']);
            }

            return Http::response('x', 206, ['Content-Range' => 'bytes 0-0/' . (500 * 1024)]);
        });

        $this->assertFalse((new RemoteImageInspector())->isEmbeddable('https://example.com/no-length.jpg'));
    }
}
