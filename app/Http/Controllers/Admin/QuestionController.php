<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\MasterSubtest;
use App\Model\MasterFacet;
use App\Model\Question;
use App\Model\AnswerCognitive;
use App\Model\AnswerInventory;
use Illuminate\Support\Facades\Storage;
use Hash;
use Request;
use Session;
use DB;
use Response;

class QuestionController extends Controller
{
    public function viewQuestionBank(){
        $listQuestion = Question::select('question.*', 'master_subtest.sub_type', 'master_subtest.name', 'master_subtest.id AS master_id')->join('master_subtest', 'question.master_subtest_id', 'master_subtest.id')->where('set', '1')->orderBy('question.master_subtest_id', 'ASC')->get()->toArray();

        $arraybaru = [];

        foreach($listQuestion as $data) {
            if(array_key_exists('master_id'.$data['master_id'], $arraybaru)) {
                continue;
            } else {
                $arraybaru['master_id'.$data['master_id']] = $data;
            }
        }

        $listQuestionBaru = [];
        foreach($arraybaru as $data) {
            array_push($listQuestionBaru, $data);
        }
        $dataQuestion = [
            "verbal" => [],
            "numeric" => [],
            "abstrak" => [],
            "inventory" => [],
        ];

        foreach($listQuestionBaru as $key) {
            if ($key['master_subtest_id'] == "1" || $key['master_subtest_id'] == "2" || $key['master_subtest_id'] == "3" || $key['master_subtest_id'] == "4") {
                array_push($dataQuestion['verbal'], $key);
            }else if ($key['master_subtest_id'] == "5" || $key['master_subtest_id'] == "6" || $key['master_subtest_id'] == "7" || $key['master_subtest_id'] == "8") {
                array_push($dataQuestion['numeric'], $key);
            }else if ($key['master_subtest_id'] == "9" || $key['master_subtest_id'] == "10" || $key['master_subtest_id'] == "11" || $key['master_subtest_id'] == "12") {
                array_push($dataQuestion['abstrak'], $key);
            }else{
                array_push($dataQuestion['inventory'], $key);
            }
        }
        // dd($dataQuestion);
        return view('admin.question_bank.question-bank-list')->with(['pageTitle' => 'Manajemen question bank', 'title' => 'Manajemen question bank', 'sidebar' => 'manajemen_question', 'question'=>$dataQuestion]);
    }

    public function listQuestion(){
        $set = Request::input('set');
        $listQuestion = Question::select('question.*', 'master_subtest.sub_type', 'master_subtest.name', 'master_subtest.id AS master_id')->join('master_subtest', 'question.master_subtest_id', 'master_subtest.id')->where('set', $set)->orderBy('question.master_subtest_id', 'ASC')->get()->toArray();

        $arraybaru = [];

        foreach($listQuestion as $data) {
            if(array_key_exists('master_id'.$data['master_id'], $arraybaru)) {
                continue;
            } else {
                $arraybaru['master_id'.$data['master_id']] = $data;
            }
        }

        $listQuestionBaru = [];
        foreach($arraybaru as $data) {
            array_push($listQuestionBaru, $data);
        }
        $dataQuestion = [
            "verbal" => [],
            "numeric" => [],
            "abstrak" => [],
            "inventory" => [],
        ];

        foreach($listQuestionBaru as $key) {
            if ($key['master_subtest_id'] == "1" || $key['master_subtest_id'] == "2" || $key['master_subtest_id'] == "3" || $key['master_subtest_id'] == "4") {
                array_push($dataQuestion['verbal'], $key);
            }else if ($key['master_subtest_id'] == "5" || $key['master_subtest_id'] == "6" || $key['master_subtest_id'] == "7" || $key['master_subtest_id'] == "8") {
                array_push($dataQuestion['numeric'], $key);
            }else if ($key['master_subtest_id'] == "9" || $key['master_subtest_id'] == "10" || $key['master_subtest_id'] == "11" || $key['master_subtest_id'] == "12") {
                array_push($dataQuestion['abstrak'], $key);
            }else{
                array_push($dataQuestion['inventory'], $key);
            }
        }

        return response()->json($dataQuestion);
    }
    
    public function viewQuestionBankAdd(){
        $cognitive = MasterSubtest::where('type', 'Cognitive')->get()->toArray();
        $inventory = MasterSubtest::where('type', 'Inventory')->get()->toArray();
        $facet = MasterFacet::get()->toArray();
        // dd($facet);
        $breadcrumb = [
            "page"      => "Manage Question Bank",
            "detail"    => "Create New Question Bank",
            "route"     => "/HR/question_bank"
        ];
        return view('admin.question_bank.question-bank-add')->with([
            'pageTitle' => 'Manajemen question bank', 
            'title' => 'Manajemen question bank', 
            'sidebar' => 'manajemen_question', 
            'breadcrumb' => $breadcrumb, 
            'cognitive'=>$cognitive, 
            'inventory'=>$inventory[0],
            'facet'=>$facet
        ]);
    }

    public function addQuestionBank(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, Request::all());
        if ($data['testType'] == "2") {
            $insertQuestion = Question::insertGetId([
                'set' => $data['setTest'],
                'test_type' => $data['testType'],
                'master_subtest_id' => $data['subInventory'],
            ]);

            if ($insertQuestion) {
                for ($i=0; $i < $data['countAnswer']; $i++) { 
                    $insertAnswer = AnswerInventory::insert([
                        'question_id' => $insertQuestion,
                        'master_facet_id' => $data['facetType'.$i],
                        'choice'      => $data['choice'.$i],
                        'answer_text' => $data['answerQA8'.$i],
                    ]);
                }
            }else{
                $messages = [
                    'status' => 'error',
                    'message' => 'Gagal Membuat Question Bank',
                    'url' => 'close'
                ];
    
                return back()->with('notif', $messages);
            }

        }else {
            if ($data['subCognitive'] == "1" || $data['subCognitive'] == "3" || $data['subCognitive'] == "4" || $data['subCognitive'] == "7") {
                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'question_text' => $data['questionQA1'],
                    'answer_keys' => $data['chooseAnswer'],
                ]);

                if ($insertQuestion) {
                    for ($i=0; $i < $data['countAnswer']; $i++) { 
                        $insertAnswer = AnswerCognitive::insert([
                            'question_id' => $insertQuestion,
                            'choice'      => $data['choice'.$i],
                            'answer_text' => $data['answerQA1'.$i],
                        ]);
                    }
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else if ($data['subCognitive'] == "5") {
                if (Request::has('imgNumeric1')) {
                    $image = Request::file('imgNumeric1');
                    $ext = $image->getClientOriginalExtension();    
                    $imgNumeric1 = $image->storeAs('bank-question', 'numeric1_'.time().'.'.$ext, 'public');
                    // $sql->image_logo = $path; di db nggk ada kolomnya
                }else{
                    $imgNumeric1 = "";
                }
                
                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'question_text' => $data['questionQA2'],
                    'question_image' => $imgNumeric1,
                    'answer_keys' => $data['chooseAnswer'],
                ]);
                
                if ($insertQuestion) {
                    for ($i=0; $i < $data['countAnswer']; $i++) { 
                        $insertAnswer = AnswerCognitive::insert([
                            'question_id' => $insertQuestion,
                            'choice'      => $data['choice'.$i],
                            'answer_text' => $data['answerQA2'.$i],
                        ]);
                    }
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else if ($data['subCognitive'] == "8") {
                if (Request::has('imgNumeric4')) {
                    $image = Request::file('imgNumeric4');
                    $ext = $image->getClientOriginalExtension();    
                    $imgNumeric4 = $image->storeAs('bank-question', 'numeric4_'.time().'.'.$ext, 'public');
                    // $sql->image_logo = $path; di db nggk ada kolomnya
                }else{
                    $imgNumeric4 = "";
                }

                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'question_text' => $data['questionQA3'],
                    'question_image' => $imgNumeric4,
                    'answer_keys' => $data['chooseAnswer'],
                ]);
                
                if ($insertQuestion) {
                    for ($i=0; $i < $data['countAnswer']; $i++) { 
                        $insertAnswer = AnswerCognitive::insert([
                            'question_id' => $insertQuestion,
                            'choice'      => $data['choice'.$i],
                            'answer_text' => $data['answerQA3'.$i],
                        ]);
                    }
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }

            }else if ($data['subCognitive'] == "2") {
                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'question_text' => $data['questionQA4'],
                    'answer_keys' => $data['chooseAnswer'],
                ]);

                if ($insertQuestion) {
                    $insertAnswer = AnswerCognitive::insert([
                        'question_id' => $insertQuestion,
                        'answer_text' => $data['conclusionQA4'],
                    ]);
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else if ($data['subCognitive'] == "6") {
                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'answer_keys' => $data['chooseAnswer'],
                ]);

                if ($insertQuestion) {
                    for ($i=0; $i < $data['countAnswer']; $i++) { 
                        $insertAnswer = AnswerCognitive::insert([
                            'question_id' => $insertQuestion,
                            'choice'      => $data['choice'.$i],
                            'answer_text' => $data['answerQA5'.$i],
                        ]);
                    }
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else if ($data['subCognitive'] == "9" || $data['subCognitive'] == "10" || $data['subCognitive'] == "12") {
                if (Request::has('imgAbstrak')) {
                    $imgAbstrak = Request::file('imgAbstrak');
                    $extAbstrak = $imgAbstrak->getClientOriginalExtension();    
                    $imgAbstrak = $imgAbstrak->storeAs('bank-question', 'abstrak_'.time().'.'.$extAbstrak, 'public');
                    // $sql->image_logo = $path; di db nggk ada kolomnya
                }else{
                    $imgAbstrak = "";
                }

                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'question_image' => $imgAbstrak,
                    'answer_keys' => $data['chooseAnswer'],
                ]);

                if ($insertQuestion) {
                    if (Request::has('imgAnswer0')) {
                        $imgAnswer0 = Request::file('imgAnswer0');
                        $extAnswer0 = $imgAnswer0->getClientOriginalExtension();    
                        $data['imgAnswer0'] = $imgAnswer0->storeAs('bank-question', 'abstrak0_'.time().'.'.$extAnswer0, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAnswer0'] = "";
                    }
    
                    if (Request::has('imgAnswer1')) {
                        $imgAnswer1 = Request::file('imgAnswer1');
                        $extAnswer1 = $imgAnswer1->getClientOriginalExtension();    
                        $data['imgAnswer1'] = $imgAnswer1->storeAs('bank-question', 'abstrak1_'.time().'.'.$extAnswer1, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAnswer1'] = "";
                    }
    
                    if (Request::has('imgAnswer2')) {
                        $imgAnswer2 = Request::file('imgAnswer2');
                        $extAnswer2 = $imgAnswer2->getClientOriginalExtension();    
                        $data['imgAnswer2'] = $imgAnswer2->storeAs('bank-question', 'abstrak2_'.time().'.'.$extAnswer2, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAnswer2'] = "";
                    }
    
                    if (Request::has('imgAnswer3')) {
                        $imgAnswer3 = Request::file('imgAnswer3');
                        $extAnswer3 = $imgAnswer3->getClientOriginalExtension();    
                        $data['imgAnswer3'] = $imgAnswer3->storeAs('bank-question', 'abstrak3_'.time().'.'.$extAnswer3, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAnswer3'] = "";
                    }
    
                    if (Request::has('imgAnswer4')) {
                        $imgAnswer4 = Request::file('imgAnswer4');
                        $extAnswer4 = $imgAnswer4->getClientOriginalExtension();    
                        $data['imgAnswer4'] = $imgAnswer4->storeAs('bank-question', 'abstrak4_'.time().'.'.$extAnswer4, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAnswer4'] = "";
                    }

                    for ($i=0; $i < $data['countAnswer']; $i++) { 
                        $insertAnswer = AnswerCognitive::insert([
                            'question_id' => $insertQuestion,
                            'choice'      => $data['choice'.$i],
                            'answer_image' => $data['imgAnswer'.$i],
                        ]);
                    }
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else if ($data['subCognitive'] == "11") {
                $insertQuestion = Question::insertGetId([
                    'set' => $data['setTest'],
                    'test_type' => $data['testType'],
                    'master_subtest_id' => $data['subCognitive'],
                    'answer_keys' => $data['chooseAnswer'],
                ]);
                
                if ($insertQuestion) {
                    if (Request::has('imgAbstrak0')) {
                        $imgAbstrak0 = Request::file('imgAbstrak0');
                        $extAnswer0 = $imgAbstrak0->getClientOriginalExtension();    
                        $data['imgAbstrak0'] = $imgAbstrak0->storeAs('bank-question', 'abstrak30_'.time().'.'.$extAnswer0, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAbstrak0'] = "";
                    }
    
                    if (Request::has('imgAbstrak1')) {
                        $imgAbstrak1 = Request::file('imgAbstrak1');
                        $extAnswer1 = $imgAbstrak1->getClientOriginalExtension();    
                        $data['imgAbstrak1'] = $imgAbstrak1->storeAs('bank-question', 'abstrak31_'.time().'.'.$extAnswer1, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAbstrak1'] = "";
                    }
    
                    if (Request::has('imgAbstrak2')) {
                        $imgAbstrak2 = Request::file('imgAbstrak2');
                        $extAnswer2 = $imgAbstrak2->getClientOriginalExtension();    
                        $data['imgAbstrak2'] = $imgAbstrak2->storeAs('bank-question', 'abstrak32_'.time().'.'.$extAnswer2, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAbstrak2'] = "";
                    }
    
                    if (Request::has('imgAbstrak3')) {
                        $imgAbstrak3 = Request::file('imgAbstrak3');
                        $extAnswer3 = $imgAbstrak3->getClientOriginalExtension();    
                        $data['imgAbstrak3'] = $imgAbstrak3->storeAs('bank-question', 'abstrak33_'.time().'.'.$extAnswer3, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAbstrak3'] = "";
                    }
    
                    if (Request::has('imgAbstrak4')) {
                        $imgAbstrak4 = Request::file('imgAbstrak4');
                        $extAnswer4 = $imgAbstrak4->getClientOriginalExtension();    
                        $data['imgAbstrak4'] = $imgAbstrak4->storeAs('bank-question', 'abstrak34_'.time().'.'.$extAnswer4, 'public');
                        // $sql->image_logo = $path; di db nggk ada kolomnya
                    }else{
                        $data['imgAbstrak4'] = "";
                    }
                    
                    for ($i=0; $i < $data['countAnswer']; $i++) { 
                        $insertAnswer = AnswerCognitive::insert([
                            'question_id' => $insertQuestion,
                            'choice'      => $data['choice'.$i],
                            'answer_image' => $data['imgAbstrak'.$i],
                        ]);
                    }
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Gagal Membuat Question Bank',
                        'url' => 'close'
                    ];
        
                    return back()->with('notif', $messages);
                }

            }
        }
        if ($insertAnswer) {
            if ($data['btnValue'] == "continue") {
                $value = [
                    "setTest" => $data['setTest'],
                    "testType" => $data['testType'],
                ];

                if (isset($data['subCognitive'])) {
                    $value["subTest"] = $data['subCognitive'];
                }else{
                    $value["subTest"] = $data['subInventory'];
                }
                
                $messages = [
                    'status' => 'success',
                    'message' => 'Berhasil membuat Question Bank',
                    'id'    => 'formAddQuestionBank',
                    'value'  => json_encode($value),
                    'url' => 'close'
                ];
    
                return redirect('/HR/question_bank/add-question-bank')->with('notif', $messages);
            }else{
                $messages = [
                    'status' => 'success',
                    'message' => 'Berhasil membuat Question Bank',
                    'url' => 'close',
                    'value' => '',
                    'id'    => ''
                ];
    
                return redirect('/HR/question_bank')->with('notif', $messages);
            }
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Gagal Membuat Question Bank',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function viewQuestionBankDetail($id){
        $idQuestion = base64_decode(urldecode($id));
        $exp = explode("_", $idQuestion);
        if($exp[2] == "2"){
            $listQuestion = Question::where('master_subtest_id', $exp[0])->where('set', $exp[1])->with('answerInventory')->get()->toArray();
            for ($i=0; $i < count($listQuestion); $i++) { 
                $listQuestion[$i]['number'] = $i+1;
                for ($k=0; $k < count($listQuestion[$i]['answer_inventory']); $k++) { 
                    $facet = MasterFacet::where('id', $listQuestion[$i]['answer_inventory'][$k]['master_facet_id'])->get()->toArray();
                    if ($facet) {
                        $listQuestion[$i]['answer_inventory'][$k]['facet_name'] = $facet[0]['facet_name'];
                    }else{
                        $listQuestion[$i]['answer_inventory'][$k]['facet_name'] = "";
                    }
                }
            }
        }else{
            $listQuestion = Question::where('master_subtest_id', $exp[0])->where('set', $exp[1])->with('answerCognitive')->get()->toArray();   
            for ($i=0; $i < count($listQuestion); $i++) { 
                $listQuestion[$i]['number'] = $i+1;
            }
        }
        // dd($listQuestion);
        if ($listQuestion) {
            $breadcrumb = [
                "page"      => "Manage Question Bank",
                "detail"    => "View Detail Question Bank",
                "route"     => "/HR/question_bank"
            ];
            return view('admin.question_bank.question-bank-detail')->with([
                'pageTitle' => 'Manajemen question bank', 
                'title' => 'Manajemen question bank', 
                'sidebar' => 'manajemen_question', 
                'breadcrumb' => $breadcrumb,
                'data' => $listQuestion 
            ]);
        }else{
            abort(404);
        }
    }
}
