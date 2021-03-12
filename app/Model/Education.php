<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'pendidikan';

    public function candidate()
    {
        return $this->belongsTo('App\Model\Candidate');
    }
}
