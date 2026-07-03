<?php

namespace Tests\Feature\Filament;

use App\Enums\SourceType;
use App\Filament\Resources\Sources\Pages\ManageSources;
use App\Models\Source;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SourceResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function testCanListSources(): void
    {
        $sources = Source::factory()->count(3)->create();

        Livewire::test(ManageSources::class)
            ->assertCanSeeTableRecords($sources);
    }

    public function testCanCreateSource(): void
    {
        Livewire::test(ManageSources::class)
            ->callAction(CreateAction::class, data: [
                'name' => 'Laravel News',
                'url' => 'https://laravel-news.com/feed',
                'type' => SourceType::Rss->value,
                'active' => true,
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas(Source::class, [
            'name' => 'Laravel News',
            'url' => 'https://laravel-news.com/feed',
            'type' => SourceType::Rss->value,
            'active' => true,
        ]);
    }

    public function testCannotCreateSourceWithoutRequiredFields(): void
    {
        Livewire::test(ManageSources::class)
            ->callAction(CreateAction::class, data: [
                'name' => '',
                'url' => '',
                'type' => null,
            ])
            ->assertHasActionErrors([
                'name' => 'required',
                'url' => 'required',
                'type' => 'required',
            ]);
    }

    public function testCanEditSource(): void
    {
        $source = Source::factory()->create([
            'type' => SourceType::Rss,
            'active' => true,
        ]);

        Livewire::test(ManageSources::class)
            ->callAction(
                TestAction::make('edit')->table($source),
                data: [
                    'name' => 'Nom mis à jour',
                    'url' => $source->url,
                    'type' => SourceType::Scraper->value,
                    'active' => false,
                ],
            )
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas(Source::class, [
            'id' => $source->id,
            'name' => 'Nom mis à jour',
            'type' => SourceType::Scraper->value,
            'active' => false,
        ]);
    }

    public function testCanDeleteSource(): void
    {
        $source = Source::factory()->create();

        Livewire::test(ManageSources::class)
            ->callAction(TestAction::make('delete')->table($source));

        $this->assertModelMissing($source);
    }
}
