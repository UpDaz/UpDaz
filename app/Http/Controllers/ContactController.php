<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Mail\ContactConfirmation;

class ContactController extends Controller
{
    public function send(ContactRequest $request)
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
