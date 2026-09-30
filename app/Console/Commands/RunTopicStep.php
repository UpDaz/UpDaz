<?php

namespace App\Console\Commands;

use App\Jobs\GenerateSeoArticleJob;
use App\Jobs\PrepareInterviewJob;
use App\Jobs\ProposeArticleUpdateJob;
use App\Models\WeeklyDigest;
use Illuminate\Console\Command;

class RunTopicStep extends Command
{
    public const PREPARE_INTERVIEW = 'prepare-interview';

    public const DRAFT = 'draft';

    public const PROPOSE_UPDATE = 'propose-update';

    protected $signature = 'blog:topic {step : prepare-interview, draft ou propose-update} {digest}';

    protected $description = 'Runs one AI step of a topic in a dedicated process, so the slow AI call never exceeds Discord\'s 3-second response window.';

    public function handle(): int
    {
        $digest = WeeklyDigest::find($this->argument('digest'));

        if (! $digest) {
            $this->error("Sujet #{$this->argument('digest')} introuvable.");

            return self::FAILURE;
        }

        $job = match ($this->argument('step')) {
            self::PREPARE_INTERVIEW => new PrepareInterviewJob($digest),
            self::DRAFT => new GenerateSeoArticleJob($digest),
            self::PROPOSE_UPDATE => new ProposeArticleUpdateJob($digest),
            default => null,
        };

        if (! $job) {
            $this->error("Étape « {$this->argument('step')} » inconnue.");

            return self::FAILURE;
        }

        $this->info("Sujet #{$digest->id} : étape {$this->argument('step')}...");

        $job->handle();

        return self::SUCCESS;
    }
}
