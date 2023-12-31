<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_skill', 'skill_id', 'user_id');
    }

}
