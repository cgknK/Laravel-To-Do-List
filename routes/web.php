<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('index');
});
*/

//Notes
//Route::get('/', [\App\Http\Controllers\NotesController::class, 'welcome']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    session()->put('welcome', true);
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Yer uygunluğuna bak
Route::resource('note-s', \App\Http\Controllers\NotesController::class);
/*
Route::get('/note-s', [NotesController::class, 'index'])->name('note-s.index');
Route::get('/note-s/create', [NotesController::class, 'create'])->name('note-s.create');
Route::post('/note-s', [NotesController::class, 'store'])->name('note-s.store');
Route::get('/note-s/{note}', [NotesController::class, 'show'])->name('note-s.show');
Route::get('/note-s/{note}/edit', [NotesController::class, 'edit'])->name('note-s.edit');
Route::put('/note-s/{note}', [NotesController::class, 'update'])->name('note-s.update');
Route::patch('/note-s/{note}', [NotesController::class, 'update']);
Route::delete('/note-s/{note}', [NotesController::class, 'destroy'])->name('note-s.destroy');
 */

//Route::get('e-mail', 'ckk.devtest@gmail.com');
Route::get('/send-welcome-email', [mailController::class, 'send'])->name('email.send');
//Route::post('/send-email', [mailController::class, 'send'])->name('email.post');
