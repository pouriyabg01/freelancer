<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index' , compact('jobs'));
    }

    public function userJob()
    {
        $user = Auth::user();
        $jobs = $user->job;
        return view('jobs.index' , compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(jobRequest $request)
    {
        $user = Auth::user();

        $user->job()->create($request->all());
        return redirect('myjobs');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        $User = Auth::user();

        if (Auth::check()) {
            switch ($User->roleIs()) {
                case 'freelancer':
                    $Threads = array();
                    $Threadss = $User->thread()->where('job_id', $job->id)->first();
                    if (is_null($Threadss)) {
                        $Threads = false;
                    } else {
                        $Threads[] = $Threadss;
                    }
                    $UserType = 'freelancer';
                    break;
                case 'client':

                    $UserType = 'client';
                    $Threads = $User->thread;

                    break;
                default:
                    $UserType = false;
                    $Threads = array();
                    break;
            }
            $data = ['job'  => $job , 'UserType' => $UserType , 'Threads' => $Threads];

        }else{
            $data = ['job' =>$job];
        }
        return view('jobs.single' , $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.edit' , compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Validator::make($request->all() ,[
            'user_id' => ['required','numeric'],
            'title' => ['required','string'],
            'description' => ['required','string'],
            'budget' => ['required','numeric']
        ]);
        Job::findOrFail($id)->update([
            'title' => $request->title,
            'description' =>$request->description,
            'budget' =>$request->budget,
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Job::findOrFail($id)->delete();
        return redirect('myjobs');
    }
}
