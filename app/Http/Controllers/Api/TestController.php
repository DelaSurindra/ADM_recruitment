<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Test;
use App\Model\Question;
use Illuminate\Support\Facades\Validator;
use App\Model\TestParticipant;

class TestController extends Controller
{
    //

    public function getSoal(Request $request){

    	$validator = Validator::make($request->all(), ["test_participant_id" => "required"]);

        if($validator->fails()) {
            return response()->json(["code"=>"500","message"=>$validator->errors()]);
        }
    	
    	$setTest = self::getSetTest($request->test_participant_id);

    	if(!$setTest){
    		return response()->json(["code"=>"404","message"=>"Participant not found"]);
    	}

    	return self::getQuestions($setTest);
    	
    }

    protected function getSetTest($testParticipantId){
    	$participant = TestParticipant::find($testParticipantId);

    	if(!$participant){
    		return false;
    	}

    	return $participant->set_test;
    }

    protected function getQuestions($testSets){
 
    	$testSets = explode(",", $testSets);
    	$question = Question::leftJoin("master_subtest","master_subtest.id","question.master_subtest_id")
    						->leftJoin("answer_inventory","answer_inventory.question_id","question.id")
    						->leftJoin("answer_cognitive","answer_cognitive.question_id","question.id")
    						->leftJoin("master_facet","master_facet.id","answer_inventory.master_facet_id")
    						->where("question.set",$testSets[0]);

    	if(sizeof($testSets)>1){
    		for ($i=1; $i < sizeof($testSets); $i++) { 
    			$question = $question->orWhere("question.set",$testSets[$i]);
    		}
    	}

    	$question = $question->select("question.id as q_id",
    		"question.set",
    		"master_subtest.type",
    		"master_subtest.sub_type",
    		"master_subtest.time",
    		"master_subtest.total_soal",
    		"question.question_text",
    		"question.question_image",
    		"answer_cognitive.id as ac_id",
    		"answer_cognitive.choice as ac_choice",
    		"answer_cognitive.answer_text as ac_answer_text",
    		"answer_cognitive.answer_image as ac_answer_image",
    		"answer_inventory.id as ai_id", 
    		"answer_inventory.choice as ai_choice",
    		"answer_inventory.answer_text as ai_answer_text",
    		"answer_inventory.answer_image as ai_answer_image",
    		"master_facet.id",
    		"master_facet.facet_name",
    		"master_facet.category"
    	);

    	$result = self::formatingQuestion($question->get());
    	// $result = $question->get();

    	return response(["code"=>"200","count"=>sizeof($result),"data"=>$result]);
    }

    protected function formatingQuestion($questions){
    	$formatedQuestion = [];
    	$answers = [];
    	$currentId = '';
    	$index = 0;
    	foreach ($questions as $_question) {
    		# code...
    		if($_question["ac_id"] != null){
    			$answer = [
    				"id"	=> $_question["ac_id"],
    				"choice" => $_question["ac_choice"],
    				"text"	=> $_question["ac_answer_text"],
    				"image"	=> $_question["ac_answer_image"]
    			];
    		}else{
    			$answer = [
    				"id"	=> $_question["ai_id"],
    				"choice" => $_question["ai_choice"],
    				"text"	=> $_question["ai_answer_text"],
    				"image"	=> $_question["ai_answer_image"]
    			];
    		}

    		if($_question["q_id"] != $currentId){
    			$question = [
	    			"id"		=> $_question["q_id"],
	    			"type" 		=> $_question["type"],
	    			"sub_type" 	=> $_question["sub_type"],
	    			"text"		=> $_question["question_text"],
	    			"image"		=> $_question["question_image"],
	    			"answers"	=> []
	    		];
    			$question["answers"][] = $answer;

	    		array_push($formatedQuestion, $question);
	    		$index++;
    		}else{
    			$formatedQuestion[$index-1]["answers"][]=$answer;
    			// array_push($formatedQuestionAnswer,$answer);
    		}

    		$currentId = $_question["q_id"];
    	}

    	return $formatedQuestion;
    }
}
