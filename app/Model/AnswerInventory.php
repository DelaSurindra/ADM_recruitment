<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnswerInventory extends Model
{
    protected $table = 'answer_inventory';

    public function question()
    {
        return $this->belongsTo('App\Model\Question');
    }
}
