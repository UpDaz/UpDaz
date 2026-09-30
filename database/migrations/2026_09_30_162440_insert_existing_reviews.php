<?php

use App\Models\Review;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $existingReviews = [
            [
                'name' => 'Linda R',
                'reviewed_at' => '2025-11-01',
                'platform' => 'google',
                'rating' => 5,
                'content' => "Nous avons fait appel à Matthieu pour le développement web de notre activité, et nous sommes pleinement satisfaits !\nProfessionnel, réactif, à l'écoute, et toujours dans une belle synergie avec nos autres prestataires.\nUn partenaire fiable et agréable avec qui nous continuerons à collaborer sans hésitation.\nMerci Matthieu !",
            ],
            [
                'name' => 'Amélie D.',
                'reviewed_at' => '2025-09-02',
                'platform' => 'google',
                'rating' => 5,
                'content' => "J'ai fait confiance à la société Updaz pour la réalisation de mon site internet professionnel, je suis très satisfaite autant pour l'accompagnement, la clarté et la rapidité des échanges que pour la réalisation en elle-même. Merci pour la réactivité, le professionnalisme et la qualité du travail de Matthieu !",
            ],
            [
                'name' => 'David',
                'reviewed_at' => '2025-09-01',
                'platform' => 'google',
                'rating' => 5,
                'content' => "Matthieu m'accompagné sur une réalisation d'un site web.\nDisponibilité, écoute et réactivité.\nJe recommande.",
            ],
            [
                'name' => 'Remy G.',
                'reviewed_at' => '2025-07-01',
                'platform' => 'google',
                'rating' => 5,
                'content' => "Nous sommes ravis d'un super travail avec Matthieu, professionnel, disponible et compétent.\nMerci !",
            ],
            [
                'name' => 'Carla',
                'reviewed_at' => '2023-06-01',
                'platform' => 'malt',
                'rating' => 5,
                'content' => 'Mission réalisée efficacement pour un prix très abordable. Le travail a été fait très rapidement et j\'ai pu faire de nombreux retours sur lesquels Mathieu a retravaillé. Je recommande',
            ],
        ];

        foreach ($existingReviews as $existingReview) {
            Review::query()->create($existingReview);
        }
    }
};
