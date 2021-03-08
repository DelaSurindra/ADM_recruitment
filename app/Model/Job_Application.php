<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job_Application extends Model
{
    protected $table = 'job_application';

    public function candidate()
    {
        return $this->belongsTo('App\Model\Kandidat');
    }
}
