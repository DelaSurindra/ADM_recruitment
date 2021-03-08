<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function viewQuestionBank(){
        return view('admin.question_bank.question-bank-list')->with(['pageTitle' => 'Manajemen question bank', 'title' => 'Manajemen question bank', 'sidebar' => 'manajemen_question']);
    }
}
