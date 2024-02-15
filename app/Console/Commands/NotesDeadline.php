<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Note;
use Carbon\Carbon;
use Mail;
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
        $today = Carbon::now();

        $notes = Note::where('is_remember', '=', true)
            ->where('remember_date', '>', $today)
            ->where('remember_date', '<', $today->addMinutes(5))
            ->where('deleted_at', null)
            ->get();

        foreach ($notes as $note) {
            mailController::send($note->id);
        }
    }
}
