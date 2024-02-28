<?php

namespace App\Http\Controllers;

use App\Events\ReminderSetEvent;
use App\Models\Note;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use MongoDB\Driver\Session;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $one_user_notes = Note::whereNull('deleted_at')
            ->where('note_user_id', Auth::id())->with('user')
            ->get();

        //session()->put('welcome', true);

        //$rememberDate = new DateTime($note->remember_date);
        //$overdue = $rememberDate < new DateTime();

        return view('index', compact('one_user_notes'));

        //sadece kendi notlarn görmeli
        //$one_user_notes = Note::all();
        //return view('index', compact('one_user_notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Buradaki hangi create???????S
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['note_user_id' => Auth::id()]);
        if ($request->input('is_remember') ==  "on") {
            $request->merge(['is_remember' => 1]);
        }
        else {
            $request->merge(['is_remember' => 0]);
        }

        $messages = [
            'description.required' => 'min 1 chr, pls.',
        ];

        $validate_data = $request->validate([
            'description' => 'required|string|between:1,99999',
            //'is_remember' => 'in:0,1',
        ], $messages);
        //dd($validate_data);
        $sanitizedDesc = htmlspecialchars($validate_data['description']);
        //diğerleri ???
        //$sanitizedXxx = htmlspecialchars($validate_data['description']);


        /*
         * $request->merge([
            'is_remember' => $request->input('is_remember') === 'on' ? 1 : 0,
        ]);
         */
        /*
        $validated = request()->validate([
            'title' => 'required_without:description',
            'description' => 'required_without:title|email',
        ]);
        */

        //try catch
        $created_note = Note::create($request->all());
        //Note::create($validated);

        event(new ReminderSetEvent($created_note));

        session()->flash('successS',
            ["Successfull Store", "$created_note->created_at", "$created_note->title"]);

        return redirect('/notes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::findOrFail($id);
        return view('show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $note = Note::findOrFail($id);
        return view('update', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //is_reminder da default olarak off yapma sorunu var fakat veritabanına karışmıyor
        //sadece görsel bir sorun

        if ($request->input('is_remember') ==  "on") {
            $request->merge(['is_remember' => 1]);
        }
        else {
            $request->merge(['is_remember' => 0]);
        }

        $note = Note::findOrFail($id);
        $note->update($request->all());

        session()->flash('successU', "Succesfull Update: $request->title");

        return redirect('/notes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        //need warning notification
        //$note->delete();
        $note->update(['deleted_at' => date('Y-m-d H:i:s')]);

        //birini kullanmak yeterli, best practice araştır
        session()->flash('successD', "Succesfull Destroy: $note->title");
        $deleted_note = $note;

        return redirect('/notes')->with('deleted_note', $deleted_note);
    }

    /*
    public function isExpired()
    {
        return $this->deadline < now();
    }
    */
}
