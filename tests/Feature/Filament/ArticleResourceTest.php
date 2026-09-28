<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Articles\Pages\EditArticle;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
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
}
