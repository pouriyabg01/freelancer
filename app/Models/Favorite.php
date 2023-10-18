<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'job_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public static function ifAdd($id)
    {
        if ($user = Auth::user()) {
            return Favorite::where('user_id' , $user->id)->where('job_id' , $id)->first();
        }
    }

}
