<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function addFavourites(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        if(Favorite::ifAdd($request->job_id)) {
            $user = Auth::user();
            $user->favorite()->where('job_id' , $request->job_id)->first()->delete();
            return back();
        }

        if (Auth::user()->roleIs('client')){
            return back();
            // show ERROR only freelancer could add job to favorites
        }
        Validator::make($request->all() , [
            'job_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        Favorite::create([
            'job_id' => $request->input('job_id'),
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function userFaveJobs()
    {
        $user = auth()->user();
        if (!is_null($user)){
            if ($user->roleIs('freelancer')){
                $favourites = $user->favourites;
                if (count($favourites ) > 0){
                    $favourites = $favourites;
                }else{
                    $favourites = false;
                }
            }else{
                $favourites = false;
            }
        }else{
            $favourites = false;
        }
        return view('jobs.fave' , compact('favourites'));
    }
}
