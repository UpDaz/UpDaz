<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * The form posts through axios, but also works without JavaScript:
     * the plain HTML submission is redirected back to the form.
     */
    public function send(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $data = $request->validated();

        Mail::to(config('custom.email.contact'))
            ->send(
                new Contact(
                    $data['lastname'],
                    $data['firstname'],
                    $data['email'],
                    $data['phone'] ?? null,
                    $data['message']
                )
            );

        if ($request->expectsJson()) {
            return response()->json();
        }

        return redirect()->to(route('home', ['contact' => 'envoye']) . '#contact');
    }
}
