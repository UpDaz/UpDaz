<?php

namespace Tests\Feature\AI;

use App\AI\Promptable;
use Prism\Prism\Exceptions\PrismProviderOverloadedException;
use Prism\Prism\Exceptions\PrismRateLimitedException;
use Tests\TestCase;

class PromptableRateLimitRetryTest extends TestCase
{
    private function subject(): object
    {
        return new class
        {
            use Promptable;

            public function callWithRetries(callable $callback): object
            {
                return $this->withRateLimitRetries($callback);
            }
        };
    }

    public function testRetriesAfterARateLimitAndEventuallySucceeds(): void
    {
        config(['ai.max_retry_attempts' => 3, 'ai.retry_delay_seconds' => 0]);

        $attempts = 0;

        $result = $this->subject()->callWithRetries(function () use (&$attempts) {
            $attempts++;

            if ($attempts < 3) {
                throw PrismRateLimitedException::make([]);
            }

            return (object) ['ok' => true];
        });

        $this->assertSame(3, $attempts);
        $this->assertTrue($result->ok);
    }

    public function testRetriesAfterProviderOverloadedAndEventuallySucceeds(): void
    {
        config(['ai.max_retry_attempts' => 2, 'ai.retry_delay_seconds' => 0]);

        $attempts = 0;

        $result = $this->subject()->callWithRetries(function () use (&$attempts) {
            $attempts++;

            if ($attempts < 2) {
                throw PrismProviderOverloadedException::make('gemini');
            }

            return (object) ['ok' => true];
        });

        $this->assertSame(2, $attempts);
        $this->assertTrue($result->ok);
    }

    public function testGivesUpAfterMaxAttemptsAndRethrows(): void
    {
        config(['ai.max_retry_attempts' => 2, 'ai.retry_delay_seconds' => 0]);

        $attempts = 0;

        $this->expectException(PrismRateLimitedException::class);

        $this->subject()->callWithRetries(function () use (&$attempts) {
            $attempts++;

            throw PrismRateLimitedException::make([]);
        });
    }
}
