<?php

namespace App\Http\Controllers;

use App\Events\ReminderSetEvent;
use App\Models\Note;
use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
        if(1){
            if ($request->title == '+255'){
                $rand = 1;
                Log::info($request->title);
                for ( $i=0; strlen($request->title)<=255; ++$i ) {
                    $request->title .= "$i";
                }
                Log::info($request->title);
                Log::info(strlen($request->title));
                //$request->title = $sanitizedTitle;
            }
            else {
                mt_srand();
                $rand = mt_rand(0, 1);
            }

            // Sanitize input data
            $sanitizedTitle = htmlspecialchars($request->title);
            $sanitizedDesc = htmlspecialchars($request->description);
            //$sanitizedIsRemember = htmlspecialchars($request->is_remember);//unness...
            $sanitizedDate = htmlspecialchars($request->remember_date);

            // Merge sanitized data with request
            $request->merge([
                'title' => $sanitizedTitle,
                'description' => $sanitizedDesc,
                'remember_date' => $sanitizedDate,
                'note_user_id' => Auth::id(),
                'is_remember' => $request->input('is_remember') === 'on' ? 1 : 0,
            ]);


            // Validate input data
            $messages = [
                'title.string' => 'Başlık alanı bir metin olmalıdır.',
                'title.max' => 'Başlık alanı 255 karakterden fazla olamaz.',
                'description.required' => 'min 1 chr, pls.',
                'is_remember.int' => 'Lütfen destek ile iletişimi geçiniz. Code:S01',
            ];

            /*
             laravel 10.x
            $validatedData = $request->validate([
                'title' => ['required', 'unique:posts', 'max:255'],
                'body' => ['required'],
            ]);
             */
            if($rand){
                $validate_data = $request->validate([
                    'title' => 'string|max:255',
                    'description' => 'required|string|between:1,99999',
                    'note_user_id' => 'required|integer',
                    'is_remember' => 'in:0,1',
                    'remember_date'=> 'date',
                ], $messages);
            }
            else {
                $validate_data = $request->validate([
                    'title' => 'string|max:255',
                    'description' => 'required|string|between:1,99999',
                    //'note_user_id' => 'required|integer',
                    'is_remember' => 'between:0,1',
                    'remember_date'=> 'nullable|date',
                ], $messages);
            }

            // Try to create note and handle errors
            try {
                $created_note = Note::create($validate_data);

                // Trigger reminder event
                event(new ReminderSetEvent($created_note));

                // Flash success message
                session()->flash('successS', [
                    "Successful Store",
                    "$created_note->created_at",
                    "$created_note->title"
                ]);

                // Redirect to notes page
                return redirect('/notes');
            } catch (Exception $e) {
                // Log error message
                Log::error($e->getMessage());

                // Flash error message
                return back()->withErrors(['errorS' => 'The note could not be created.']);
            }
        }
        else {
            $sanitizedIsRemember = htmlspecialchars($request->is_remember);
            $request->merge(['note_user_id' => Auth::id()]);

            /*
            if ($request->input('is_remember') ==  "on") {
                $request->merge(['is_remember' => 1]);
            }
            else {
                $request->merge(['is_remember' => 0]);
            }
            */

            $messages = [
                'description.required' => 'min 1 chr, pls.',
            ];

            $validate_data = $request->validate([
                'title' => 'string|max:255',
                'description' => 'required|string|between:1,99999',
                'remember_date'=> 'date',
                //'date' => 'required|date_format:Y-m-d',
                //'is_remember' => 'in:0,1',
            ], $messages);
            //dd($validate_data);
            //dd($request);
            $sanitizedTitle = htmlspecialchars($request->title);
            $sanitizedDesc = htmlspecialchars($validate_data['description']);
            //is_remember yukarıda, yeri sorunlu
            $sanitizedTitle = htmlspecialchars($request->remember_date);
            //dd($sanitizedDesc);
            //diğerleri ???
            //$sanitizedXxx = htmlspecialchars($validate_data['description']);
            $request->merge([
                'description' => $sanitizedDesc,
            ]);

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
            //$created_note = Note::create($request->all());
            $created_note = Note::create([
                'title' => $request->title,
                'description' => $sanitizedDesc,
                'note_user_id' => Auth::id(),
                'is_remember' => $request->input('is_remember') === 'on' ? 1 : 0,
            ]);
            /*
             $query = DB::table('users')->insert([
                'name' => $sanitizedName,
                'email' => $sanitizedEmail,
                'password' => $hashedPassword,
            ]);
             */
            //Note::create($validated);

            if ($created_note) {
                event(new ReminderSetEvent($created_note));

                session()->flash('successS',
                    ["Successful Store", "$created_note->created_at", "$created_note->title"]);

                return redirect('/notes');
            } else {
                // Not oluşturma sırasında hata yönetimi ekleyin (örn. doğrulama hataları, veritabanı bağlantı sorunları)
                return back()->withErrors(['error' => 'Kullanıcı oluşturulamadı.']);
            }
            /*
        event(new ReminderSetEvent($created_note));

        session()->flash('successS',
            ["Successfull Store", "$created_note->created_at", "$created_note->title"]);

        return redirect('/notes');
            */
        }

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
