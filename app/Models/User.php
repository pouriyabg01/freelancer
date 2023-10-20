<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roleIs($role = null)
    {
        if (is_null($role))
            return auth()->user()->role;
        return auth()->user()->role == $role;
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function favorites(){
        return $this->belongsToMany(Job::class , 'favorites');
    }

    public function addToFavorite(Job $job)
    {
        return $this->favorites()->attach($job->id);
    }

    public function removeFromFavorite(Job $job)
    {
        return $this->favorites()->detach($job->id);
    }

    public function favoriteJobs()
    {
        return $this->hasManyThrough(Job::class, Favorite::class, 'user_id', 'id', 'id', 'job_id');
    }


    public function threads(){
        return $this->belongsToMany(Thread::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }

    public function getRouteKeyName()
    {
        return 'username'; // Use the name field for route model binding
    }
}
