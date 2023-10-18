<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index'])->name('index');

// Group with 'auth' and 'verified' middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('myprofile' , function (){
        return view('profile.dashboard');
    });

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('profile/jobs', JobController::class)->except(['index']);
    Route::get('myjobs', [JobController::class, 'userJob']);

    Route::post('addToFave', [FavoriteController::class, 'addFavourites'])->name('addToFave');

    Route::post('threads', [ThreadController::class, 'createThread'])->name('createThread');
    Route::post('threads/{id}/newMessage', [ThreadController::class, 'createMessage'])->name('createMessage');
    Route::get('thread/{id}', [ThreadController::class, 'showThread']);
});

require __DIR__.'/auth.php';