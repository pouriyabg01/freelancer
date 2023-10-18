<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = ['job_id'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
