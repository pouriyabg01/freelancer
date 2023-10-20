<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', [JobController::class, 'index'])->name('index');

Route::get('user/{user}' , [ProfileController::class , 'user']);
Route::get('search' , [JobController::class , 'search'])->name('search');


// Group with 'auth' and 'verified' middleware
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');//TODO freelnacer can edit and update skill done
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/jobs/favorites', [ProfileController::class, 'favorites'])->name('jobs.favorite');

    Route::resource('profile/jobs', JobController::class)->except(['index']);
    Route::get('myjobs', [JobController::class, 'userJob'])->name('my.jobs');
    Route::get('addToFave', FavoriteController::class)->name('addToFave')->middleware('can:favorite-job');

    Route::post('threads', [ThreadController::class, 'createThread'])->name('createThread')->middleware('can:send-message');
    Route::post('threads/{id}/newMessage', [ThreadController::class, 'createMessage'])->name('createMessage');
    Route::get('thread/{id}', [ThreadController::class, 'showThread']);

});

require __DIR__.'/auth.php';
