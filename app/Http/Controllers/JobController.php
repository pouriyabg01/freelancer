<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->validate([
            'search' => 'required|string'
        ])['search'];
        $jobs = Job::where('title' , 'like' , "%$search%")->get();
        return view('index' , compact('jobs'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return view('index' , compact('jobs'));
    }

    public function userJob()
    {
        $user = Auth::user();
        $jobs = $user->jobs;
        return view('jobs.index' , compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('jobs.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(jobRequest $request)
    {
        $user = Auth::user();
        $job = $user->jobs()->create($request->all());

        if ($request->category)
            $job->category()->attach(array_values($request->category));

        return redirect('myjobs');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = Job::find($id);
        $User = Auth::user();

        if (Auth::check()) {
            switch ($User->roleIs()) {
                case 'freelancer':
                    $Threads = array();
                    $Threadss = $User->threads()->where('job_id', $job->id)->first();
                    if (is_null($Threadss)) {
                        $Threads = false;
                    } else {
                        $Threads[] = $Threadss;
                    }
                    $UserType = 'freelancer';
                    break;
                case 'client':

                    $UserType = 'client';
                    $job = $User->jobs()->find($id);
                    $Threads = $job->threads;

                    break;
                default:
                    $UserType = false;
                    $Threads = array();
                    break;
            }
            $data = ['User' => $User , 'UserType' => $UserType , 'job'  => $job , 'Threads' => $Threads];

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
        $categories = Category::all();
        $jobCategory = array_values($job->category()->pluck('category_id')->toArray());
        return view('jobs.edit' , compact('job' , 'categories' , 'jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        Validator::make($request->all() ,[
            'user_id' => ['required','numeric'],
            'title' => ['required','string'],
            'description' => ['required','string'],
            'budget' => ['required','numeric']
        ]);
        $job->update([
            'title' => $request->title,
            'description' =>$request->description,
            'budget' =>$request->budget,
        ]);
        if ($request->category)
            $job->category()->sync(array_values($request->category));
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
