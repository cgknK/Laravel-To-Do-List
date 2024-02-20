<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class mailController extends Controller
{
    public function send($note)//parametreyi comentlemeden yapmaya çalış
    {
        //$note_object = Note::find($note);

        if(1) {
            $name = $note->user->name;
            $email = $note->user->email;
            $title_ = $note->title;
            $deadlineTime = $note->remember_date;

            //$name = Auth::user()->name;
            $title = "$title_ Alarm: $deadlineTime";
            // backslashN yerine br mi koymak lazım
            $body = "Hello Dear $name\n\nYour $title_ alarm...\nLink\n\nBest,\nAppName";

            //$email = $this->getEmail();

            Mail::to("$email")->send(new WelcomeMail($title, $body));

            return view('mail', compact('title', 'body'));
        }
        else {
            $title = 'xNotu Alarm: DeadlineTime';
            $body = "Hakan Bey Merhaba, klzvcgkn@gmail.com.\nHello Dear \$name,\n\nYour notesTitle alarm...\nLink\n\nBest,\nAppName";
            //$email = "hakank.sert@gmail.com";
            $email = "";
            Mail::to("$email")->send(new WelcomeMail($title, $body));
            return view('mail', compact('title', 'body'));
        }
    }

    /*
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
    */
}
