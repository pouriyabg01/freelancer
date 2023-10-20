<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = ['job_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
