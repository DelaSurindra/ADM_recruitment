<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'pendididkan';

    public function candidate()
    {
        return $this->belongsTo('App\Model\Candidate');
    }
}
