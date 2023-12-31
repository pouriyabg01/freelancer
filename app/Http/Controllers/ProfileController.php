<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function messages()
    {
        $user = Auth::user();
        $threads = $user->threads;
        return view('jobs.messages' , compact('threads'));
    }

    public function favorites()
    {
        $user = User::with('favoriteJobs')->find(Auth::user()->id);
        $jobs = $user->favoriteJobs;

        return view('jobs.favorites' , compact('jobs'));
    }
    /*
     * Show user's dashboard for all another users
     */
    public function user(User $user)
    {
        return view('profile.dashboard' , compact('user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'skills' => Skill::all(),
            'userSkill' => array_values($request->user()->skill()->pluck('skill_id')->toArray())
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if ($request->skill){
            $request->user()->skill()->sync(array_values($request->skill));
        }


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
