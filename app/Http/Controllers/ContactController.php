<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        Mail::to(config('custom.email.contact'))
            ->send(
                new Contact(
                    $data['lastname'],
                    $data['firstname'],
                    $data['email'],
                    $data['phone'],
                    $data['message']
                )
            );

        return response()->json();
    }
}
