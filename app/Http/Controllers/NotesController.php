<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //validate() eklenecek
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

        /*
        $validated = request()->validate([
            'title' => 'required_without:description',
            'description' => 'required_without:title|email',
        ]);
        */

        //dd($request);
        Note::create($request->all());
        //Note::create($validated);

        session()->flash('successS', "Succesfull Store: $request->title");

        return redirect('/note-s');
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

        return redirect('/note-s');
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

        return redirect('/note-s')->with('deleted_note', $deleted_note);
    }

    /*
    public function isExpired()
    {
        return $this->deadline < now();
    }
    */
}
