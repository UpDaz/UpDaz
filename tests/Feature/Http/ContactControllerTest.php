<?php

namespace Tests\Feature\Http;

use App\Mail\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, string>
     */
    private function validPayload(): array
    {
        return [
            'lastname' => 'Martin',
            'firstname' => 'Julie',
            'email' => 'julie@example.com',
            'message' => 'Bonjour, j\'ai un projet d\'application web.',
        ];
    }

    public function testAjaxSubmissionReturnsJsonWithoutPhone(): void
    {
        Mail::fake();

        $response = $this->postJson(route('contact'), $this->validPayload());

        $response->assertOk();
        Mail::assertSent(Contact::class, fn (Contact $mail): bool => $mail->phone === null);
    }

    public function testHtmlSubmissionRedirectsBackToTheForm(): void
    {
        Mail::fake();

        $response = $this->post(route('contact'), $this->validPayload() + ['phone' => '0600000000']);

        $response->assertRedirect(route('home', ['contact' => 'envoye']) . '#contact');
        Mail::assertSent(Contact::class, fn (Contact $mail): bool => $mail->phone === '0600000000');
    }

    public function testConfirmationIsShownAfterAnHtmlSubmission(): void
    {
        $response = $this->get(route('home', ['contact' => 'envoye']));

        $response->assertSee('J\'ai bien reçu votre demande', false);
        $response->assertSee('role="status"', false);
    }
}
