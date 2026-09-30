<?php

namespace Tests\Feature\Models;

use App\Models\Redirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistersAPermanentRedirectWithNormalizedPaths(): void
    {
        Redirect::register('https://www.updaz.fr/articles/laravel/ancien/', '/articles/laravel/nouveau');

        $this->assertSame('/articles/laravel/nouveau', Redirect::findForPath('articles/laravel/ancien')->to_path);
    }

    public function testRegistersAGoneUrl(): void
    {
        Redirect::register('/articles/developpement/hors-sujet', null);

        $this->assertTrue(Redirect::findForPath('/articles/developpement/hors-sujet')->isGone());
    }

    public function testTargetIsResolvedToItsFinalDestination(): void
    {
        Redirect::register('/articles/b', '/articles/c');

        Redirect::register('/articles/a', '/articles/b');

        $this->assertSame('/articles/c', Redirect::findForPath('/articles/a')->to_path);
    }

    public function testRedirectsPointingAtTheNewSourceAreRewritten(): void
    {
        Redirect::register('/articles/a', '/articles/b');

        Redirect::register('/articles/b', '/articles/c');

        $this->assertSame('/articles/c', Redirect::findForPath('/articles/a')->to_path);
    }

    public function testChainsEndingOnAGoneUrlBecomeGone(): void
    {
        Redirect::register('/articles/a', '/articles/b');

        Redirect::register('/articles/b', null);

        $this->assertTrue(Redirect::findForPath('/articles/a')->isGone());
    }

    public function testALoopBackToTheSourceRemovesTheRedirect(): void
    {
        Redirect::register('/articles/a', '/articles/b');

        Redirect::register('/articles/b', '/articles/a');

        $this->assertNull(Redirect::findForPath('/articles/a'));
        $this->assertSame('/articles/a', Redirect::findForPath('/articles/b')->to_path);
    }
}
