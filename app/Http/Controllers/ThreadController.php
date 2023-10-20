<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    public function createThread(Request $request)
    {
        Validator::make($request->all() , [
            'job_id' => 'required|integer',
        ]);

        $Thread = new Thread();
        $Thread->job_id = $request->job_id;
        $Thread->save();

        $Freelancer = Auth::user();

        $Client = $Thread->Job->user;

        $Thread->users()->save($Freelancer);
        $Thread->users()->save($Client);

        return redirect('/thread/'.$Thread->id);

    }
    public function createMessage(Request $request, $id){
        $this->validate($request, [
            'message' => 'required|string',
        ]);

        $Message = new Message();
        $Message->message = $request->input('message');
        $Message->thread_id = $id;

        $User = Auth::user();

        $User->messages()->save($Message);

        return redirect('/thread/'.$id);

    }

    public function showThread($id){
        $Thread = Thread::findOrFail($id);
        return view('thread.show')->with('Thread',$Thread);
    }
}
