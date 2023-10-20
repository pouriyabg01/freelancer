<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $job = Job::findOrFail($request->job_id);
        $isFave = $job->isFavoritedBy($request->user());

        !$isFave ? $user->addToFavorite($job) : $user->removeFromFavorite($job);

        return redirect()->back();
    }
}
