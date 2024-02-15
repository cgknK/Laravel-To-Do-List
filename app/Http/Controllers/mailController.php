<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class mailController extends Controller
{
    public function send(/*string $note_id*/)//parametreyi comentlemeden yapmaya çalış
    {
        if(0) {
            $name = $note_id->user->name;
            $email = $note_id->user->email;

            //$name = Auth::user()->name;
            $title = 'xNotu Alarm: DeadlineTarih';
            $body = "Hello Dear $name\n\nYour notesTitle alarm...\nLink\n\nBest,\nAppName";

            //$email = $this->getEmail();



            Mail::to("$email")->send(new WelcomeMail($title, $body));

            return view('mail', compact('title', 'body'));
        }
        else {
            $title = 'xNotu Alarm: DeadlineTime';
            $body = "Hakan Bey Merhaba, klzvcgkn@gmail.com.\nHello Dear \$name,\n\nYour notesTitle alarm...\nLink\n\nBest,\nAppName";
            $email = "hakank.sert@gmail.com";
            Mail::to("$email")->send(new WelcomeMail($title, $body));
            return view('mail', compact('title', 'body'));
        }
    }

    public function getEmail()
    {
        $email = Auth::user()->email;
        //$user2 = Auth::getUser();
        //$user3 = Auth::user()->getAuthIdentifierName();
        //$user4 = Auth::getUser()->getAuthIdentifierName();
        //dd($user);
        //$this_user = User::findOrFail($id);
        return $email;
    }
}
