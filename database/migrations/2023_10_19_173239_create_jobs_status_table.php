<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('jobs_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_id');
            $table->enum('status', ['complete', 'in_working']);
            $table->timestamp('status_date')->useCurrent()->default(now());
            $table->unique(['user_id' , 'job_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('job_id')->references('id')->on('jobs')->cascadeOnDelete();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('jobs_status');
    }
};
