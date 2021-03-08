<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'kandidat';

    public function education()
    {
        return $this->hasMany('App\Model\Education');
    }
}
