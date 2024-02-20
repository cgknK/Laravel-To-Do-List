<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Note;
use Carbon\Carbon;
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
    public function handle(): void
    {
        $now = Carbon::now('Europe/Istanbul')->format('Y-m-d H:i:s');
        $nowAddOne = Carbon::now('Europe/Istanbul')->addMinutes(1)->format('Y-m-d H:i:s');

        $notes = Note::where('is_remember', 1)
            ->where('deleted_at', null)
            ->whereBetween('remember_date', [$now, $nowAddOne])
            ->get();
        foreach ($notes as $note) {
            $mailController = new MailController; // obje geri silindimi bu scopedan çıkınca
            $mailController->send($note); // veya her döngü adımında
            //$note->save();
        }
    }
}
