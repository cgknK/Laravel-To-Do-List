<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class mailController extends Controller
{
    public function send(): string
    {
        if(1) {
            $title = 'Welcome to the laracoding.com example email Controller';
            $body = 'Thank you for participating! Controller';

            $email = $this->getEmail();
            Mail::to("$email")->send(new WelcomeMail($title, $body));

            return "Email sent successfully!";
        }
        else {
            //
        }
    }

    public function getEmail()
    {
        $user = Auth::user();
        //
        $this_user = User::findOrFail($id);
        $e_mail = $user->email;

        return $e_mail;
    }
}
