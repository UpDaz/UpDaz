<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Articles\Pages\EditArticle;
use App\Filament\Resources\Articles\Schemas\ObsoleteUrlTargetSelect;
use App\Models\Article;
use App\Models\Category;
use App\Models\Redirect;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;

class ArticleResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());

        $kernel = Mockery::mock(ConsoleKernel::class)->makePartial();
        $kernel->shouldReceive('call')->with('sitemap:generate')->zeroOrMoreTimes();
        Artisan::swap($kernel);
    }

    public function testCanAssignSeveralCategoriesAndKeepTheMainOne(): void
    {
        $mainCategory = Category::factory()->create();
        $firstCategory = Category::factory()->create();
        $secondCategory = Category::factory()->create();

        $article = Article::factory()->create(['category_id' => $mainCategory->id]);

        Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()])
            ->fillForm([
                'categories' => [$firstCategory->id, $secondCategory->id],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertEqualsCanonicalizing(
            [$mainCategory->id, $firstCategory->id, $secondCategory->id],
            $article->categories()->pluck('categories.id')->all()
        );
    }

    public function testUnpublishingAReadableArticleRequiresDecidingWhatHappensToItsUrl(): void
    {
        $article = $this->readableArticle();

        Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()])
            ->fillForm(['is_published' => false])
            ->call('save')
            ->assertHasFormErrors(['obsolete_url_target' => 'required']);

        $this->assertTrue($article->fresh()->is_published);
    }

    public function testUnpublishingAReadableArticleRedirectsItsUrlToTheChosenTarget(): void
    {
        $article = $this->readableArticle();

        Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()])
            ->fillForm([
                'is_published' => false,
                'obsolete_url_target' => '/application-web-bordeaux',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('/application-web-bordeaux', Redirect::findForPath('/articles/laravel/mon-article')->to_path);
    }

    public function testSchedulingAReadableArticleLaterAlsoAsksForATarget(): void
    {
        $article = $this->readableArticle();

        Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()])
            ->fillForm(['published_at' => now()->addWeek()->format('Y-m-d')])
            ->call('save')
            ->assertHasFormErrors(['obsolete_url_target' => 'required']);
    }

    public function testEditingADraftDoesNotAskForATarget(): void
    {
        $article = Article::factory()->create([
            'category_id' => Category::factory()->create()->id,
            'is_published' => false,
        ]);

        Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()])
            ->assertFormFieldHidden('obsolete_url_target')
            ->fillForm(['title' => 'Nouveau titre'])
            ->call('save')
            ->assertHasNoFormErrors();
    }

    public function testDeletingAReadableArticleCanDeclareItsUrlGone(): void
    {
        $article = $this->readableArticle();

        Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()])
            ->callAction(DeleteAction::class, ['obsolete_url_target' => ObsoleteUrlTargetSelect::GONE]);

        $this->assertModelMissing($article);
        $this->assertTrue(Redirect::findForPath('/articles/laravel/mon-article')->isGone());
    }

    private function readableArticle(): Article
    {
        return Article::factory()->create([
            'slug' => 'mon-article',
            'category_id' => Category::factory()->create(['slug' => 'laravel'])->id,
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);
    }
}
