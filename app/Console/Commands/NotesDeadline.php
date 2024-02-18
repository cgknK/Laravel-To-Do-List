<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Note;
use Carbon\Carbon;
use App\Mail;
use App\Http\Controllers\mailController;

class NotesDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deadline:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deadline alarm by mail.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$today = Carbon::now();//today çok saçma?
        //$today = $today->addMinutes(50);
        //$today = date('Y-m-d H:i:s');
        //$today = date('Y-m-d H:i:s', strtotime('+5 minutes', $today));
        //$now = new DateTime();
        //$today = Carbon::now();
        //dd($today);
        //$today = $today->addMinutes(10);
        //dd($today);
        //$timestamp = $today->getTimestamp(); // Convert Carbon object to timestamp
        //$newDate = date('Y-m-d H:i:s', strtotime('+5 minutes', $timestamp));
        //dd($newDate);
        //dd($notes);

        /*
        $today = Carbon::now();
        $today_minus2 = Carbon::now()->subMinutes(20);
        $today_add15 = Carbon::now()->addMinutes(150);
        //$today_end = Carbon::today()->endOfDay();
        $today_end = Carbon::now()->addMinutes(120);
        //dd($today_end);

        // Birde burada remember_date koruyarak is_remember 0 yapmak gerekiyor
        //$note_ = Note::all()->min('id');
        $note_ = Note::where('deleted_at', null)
            ->where('is_remember', '=', '1')
            ->where('remember_date', '>=', $today_minus2)
            ->get();
        //dd($note_);
        */

        $today = Carbon::now('Europe/Istanbul');
        $today_minus2 = Carbon::now()->subMinutes(20);
        $today_add15 = Carbon::now()->addMinutes(150);
        $notes = Note::where('is_remember', '=', 1)
            ->where('remember_date', '>=', $today_minus2)
            ->where('remember_date', '<=', $today_add15)
            ->where('deleted_at', null)
            ->get();

        //dd($notes);

        foreach ($notes as $note) {
            //dd($note_);
            $mailController = new MailController; // obje geri silindimi bu scopedan çıkınca
            $mailController->send($note); // veya her döngü adımında
        }

        /*
        foreach ($notes as $note) {
            if($note->user) {
                $mailController = new MailController; // obje geri silindimi bu scopedan çıkınca
                $mailController->send($note); // veya her döngü adımında
            }
            else {
                //dd();
                $mailController = new MailController; // obje geri silindimi bu scopedan çıkınca
                $mailController->send($note); // veya her döngü adımında
            }
        }
        */
    }

    /*
    protected function getOptions()
    {
        return [
            ['minutes', null, InputArgument::OPTIONAL, 'Bildirim göndermeden önceki dakika sayısı.', 10],
        ];
    }
    */
}
