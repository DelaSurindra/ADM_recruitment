<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\MasterSubtest;
use App\Model\Wilayah;
use App\Model\Candidate;
use App\Model\Job_application;
use App\Model\Education;
use Illuminate\Support\Facades\Storage;
use Hash;
use Request;
use Session;
use DB;
use Response;

class QuestionController extends Controller
{
    public function viewQuestionBank(){
        return view('admin.question_bank.question-bank-list')->with(['pageTitle' => 'Manajemen question bank', 'title' => 'Manajemen question bank', 'sidebar' => 'manajemen_question']);
    }
    
    public function viewQuestionBankAdd(){
        $cognitive = MasterSubtest::where('type', 'Cognitive')->get()->toArray();
        $inventory = MasterSubtest::where('type', 'Inventory')->get()->toArray();
        // dd($cognitive, $inventory);
        $breadcrumb = [
            "page"      => "Manage Question Bank",
            "detail"    => "Create New Question Bank",
            "route"     => "/HR/question_bank"
        ];
        return view('admin.question_bank.question-bank-add')->with(['pageTitle' => 'Manajemen question bank', 'title' => 'Manajemen question bank', 'sidebar' => 'manajemen_question', 'breadcrumb' => $breadcrumb, 'cognitive'=>$cognitive, 'inventory'=>$inventory[0]]);
    }

    public function addQuestionBank(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        dd($data, Request::all());
    }
}
