<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job_Application extends Model
{
    protected $table = 'job_application';
    protected $fillable = ["status"];
}
