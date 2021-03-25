<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnswerCognitive extends Model
{
    protected $table = 'answer_cognitive';

    public function question()
    {
        return $this->belongsTo('App\Model\Question');
    }
}
