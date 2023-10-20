<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'title' , 'description' , 'budget'];


    public function userJob($status)
    {
        $filteredJobs = DB::table('jobs')
            ->join('jobs_status', 'jobs.id', '=', 'jobs_status.job_id')
            ->where('jobs_status.status', $status)
            ->get();
        return $filteredJobs;
    }
    public function inWorkingJobs()
    {
        $inWorkingJobs = Job::where(function ($query) {
            $query->whereIn('id', function ($subquery) {
                $subquery->from('jobs_status')
                    ->where('status', 'in_working')
                    ->select('job_id');
            });
        })->get();
        return $inWorkingJobs;
    }
    public function completedJobs()
    {
        $completedJobs = Job::where(function ($query) {
            $query->whereIn('id', function ($subquery) {
                $subquery->from('jobs_status')
                    ->where('status', 'complete')
                    ->select('job_id');
            });
        })->get();
        return $completedJobs;
    }
    public function freeJobs()
    {
        $freeJobs = Job::where(function ($query) {
            $query->whereNotIn('id', function ($subquery) {
                $subquery->from('jobs_status')
                    ->where('status', 'complete')
                    ->select('job_id');
            })->WhereNotIn('id', function ($subquery) {
                $subquery->from('jobs_status')
                    ->where('status', 'in_working')
                    ->select('job_id');
            });
        })->get();
        return $freeJobs;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isFavoritedBy(User $user)
    {
        return $this->favoritedBy()->wherePivot('user_id' , $user->id)->exists();
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class , 'favorites');
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class , 'job_category' , 'job_id' , 'category_id');
    }
}
