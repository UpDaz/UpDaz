<?php

namespace Tests\Feature\Filament;

use App\Enums\ReviewPlatform;
use App\Filament\Resources\Reviews\Pages\ManageReviews;
use App\Models\Review;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\Testing\TestAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReviewResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function testCanListReviews(): void
    {
        $reviews = Review::factory()->count(3)->create();

        Livewire::test(ManageReviews::class)
            ->assertCanSeeTableRecords($reviews);
    }

    public function testCanCreateReview(): void
    {
        Livewire::test(ManageReviews::class)
            ->callAction(CreateAction::class, data: [
                'name' => 'Jeanne M.',
                'reviewed_at' => '2026-09-01',
                'platform' => ReviewPlatform::Google->value,
                'rating' => 4,
                'content' => 'Très bon accompagnement.',
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas(Review::class, [
            'name' => 'Jeanne M.',
            'platform' => ReviewPlatform::Google->value,
            'rating' => 4,
            'content' => 'Très bon accompagnement.',
        ]);

        $this->assertSame('2026-09-01', Review::query()->firstWhere('name', 'Jeanne M.')->reviewed_at->toDateString());
    }

    public function testCannotCreateReviewWithoutRequiredFields(): void
    {
        Livewire::test(ManageReviews::class)
            ->callAction(CreateAction::class, data: [
                'name' => '',
                'reviewed_at' => null,
                'platform' => null,
                'rating' => null,
                'content' => '',
            ])
            ->assertHasActionErrors([
                'name' => 'required',
                'reviewed_at' => 'required',
                'platform' => 'required',
                'rating' => 'required',
                'content' => 'required',
            ]);
    }

    public function testCanEditReview(): void
    {
        $review = Review::factory()->create(['platform' => ReviewPlatform::Google]);

        Livewire::test(ManageReviews::class)
            ->callAction(
                TestAction::make('edit')->table($review),
                data: [
                    'name' => 'Nom mis à jour',
                    'reviewed_at' => '2025-05-01',
                    'platform' => ReviewPlatform::Malt->value,
                    'rating' => 3,
                    'content' => 'Contenu mis à jour',
                ],
            )
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas(Review::class, [
            'id' => $review->id,
            'name' => 'Nom mis à jour',
            'platform' => ReviewPlatform::Malt->value,
            'rating' => 3,
            'content' => 'Contenu mis à jour',
        ]);

        $this->assertSame('2025-05-01', $review->refresh()->reviewed_at->toDateString());
    }

    public function testCanDeleteReview(): void
    {
        $review = Review::factory()->create();

        Livewire::test(ManageReviews::class)
            ->callAction(TestAction::make('delete')->table($review));

        $this->assertModelMissing($review);
    }
}
