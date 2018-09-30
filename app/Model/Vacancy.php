<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    //
    protected $table = 'vacancies';
    protected $primaryKey = 'job_id';
    public $incrementing = false;
}
