<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    public function answerCognitive()
    {
        return $this->hasMany('App\Model\AnswerCognitive');
    }

    public function answerInventory()
    {
        return $this->hasMany('App\Model\AnswerInventory');
    }
}
