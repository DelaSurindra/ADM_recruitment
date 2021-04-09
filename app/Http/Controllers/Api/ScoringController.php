<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Test;
use App\Model\Question;
use Illuminate\Support\Facades\Validator;
use App\Model\TestParticipant;
use App\Model\CognitiveTestResult;
use App\Model\InventoryTestResult;

class ScoringController extends Controller
{
    //
    public function submitTest(Request $request){
    	$validator = Validator::make($request->all(), [
    		"test_answers" => "required|array",
    		"test_participant_id" => "required"
    	]);

    	if($validator->fails()) {
            return response()->json(["code"=>"30","message"=>$validator->errors()]);
        }

    	$cognitiveAnswers = $request->test_answers["cognitive"];
    	$inventoryAnswers = $request->test_answers["inventory"];

    	// Validate participant data
    	$participantId = decrypt($request->test_participant_id);

    	$participant = TestParticipant::find($participantId);

    	if(!$participant){
    		return response()->json(["code"=>"21","message"=>"Participant not found"]);
    	}

    	if($participant->status != 3){
    		$message = self::getStatusParticipantMessage($participant->status);
    		return response()->json(["code"=>"24","message"=>$message]);
    	}

    	$testSet = $participant->set_test;

    	// Count cognitive scores
    	$cognitiveScores = self::countCognitiveScore($testSet, $cognitiveAnswers);
    	$cognitiveScores["id_participant"] = $participantId;
    	// Save cognitive scores
    	CognitiveTestResult::insert($cognitiveScores);

    	// Count inventory scores
    	$inventoryScores = self::countInventoryScores($inventoryAnswers, $participantId);
    	// Save inventory scores
    	InventoryTestResult::insert($inventoryScores);
    	// Update status test participant
    	$participant->status = 5;
    	$participant->save();
    	

    	return response()->json(["code"=>"00","message"=>"Sukses insert score","data"=>["cognitive"=>$cognitiveScores,"inventory"=>$inventoryScores]]);

    }

     /**
    *Counting scores of cognitive question
	*@param int $testSet of participant data
	*@param array $answers of participant answers example:
		[
			{"id":"4","subtest_id":"1","answer":"a"},
			{"id":"5","subtest_id":"2","answer":"a"},
			{"id":"6","subtest_id":"3","answer":"b"}
		]
    */
    protected function countCognitiveScore($testSet,$answers){
    	$questionKeys = self::getQuestionKeys($testSet);

    	$mappedQuestionKeys = self::mapArrayById($questionKeys);
    	$mappedAnswers = self::mapArrayById($answers);
    	// dd($mappedAnswers,$mappedQuestionKeys);
    	$answerScores = [];
  		$totalScroe = 0;
    	foreach ($mappedQuestionKeys as $id => $_questionKey) {
    		$key = $_questionKey["answer_keys"];
    		$subType = strtolower(str_replace(" ", "", $_questionKey["sub_type"]));
    		if(isset($mappedAnswers[$id])){
    			$answer = $mappedAnswers[$id]["answer"];
    			if($answer == $key){
    				$score = 1;
    			}else{
    				$score = 0;
    			}
    		}else{
    			$answer = "blank";
    			$score = 0;
    		}
    		$totalScroe = $totalScroe+$score;
    		$answerScores[$subType] = $score;
    	}

    	$answerScores["skor"] = $totalScroe;
    	$answerScores["status"] = 1;

    	return $answerScores;
    }

    protected function mapArrayById($array){
    	$mappedArray = [];
    	foreach ($array as $_item) {
    		$mappedArray[$_item["id"]] = $_item;
    	}

    	return $mappedArray;
    }

    protected function getQuestionKeys($testSet){
    	$question = Question::leftJoin("master_subtest","question.master_subtest_id","master_subtest.id")
    						->where("set",$testSet)
    						->where("test_type",1)
    						->select("question.id","question.master_subtest_id","question.test_type","question.answer_keys","master_subtest.sub_type")
    						->get()
    						->toArray();

    	if(sizeof($question)==0){
    		return false;
    	}

    	return $question;
    }

    /**
	*Counting scores of inventory question
	*@param int $testSet of participant data
	*@param array $answers of participant answers example:
		[
			{"id":"4","facet_id":"1","answer":"a","score":"4"},
			{"id":"4","facet_id":"2","answer":"b", "score":"3"},
			{"id":"5","facet_id":"1","answer":"a", "score":"4"},
			{"id":"5","facet_id":"1","answer":"a", "score":"4"},
			{"id":"6","facet_id":"2","answer":"a", "score":"4"},
			{"id":"6","facet_id":"3","answer":"b", "score":"3"},
			{"id":"7","facet_id":"3","answer":"a", "score":"2"},
			{"id":"7","facet_id":"3","answer":"b", "score":"2"},
		]
    */

    protected function countInventoryScores($answers, $idParticipant){
    	$mappedAnswer = [];
    	foreach ($answers as $key => $value) {
    		# code...
    		$mappedAnswer[$value["facet_id"]][] = $value["score"];
    	}

    	$inventoryScores = [];
    	foreach ($mappedAnswer as $key => $value) {
    		# code...
    		$inventoryScores[] =["id_participant"=>$idParticipant, "facet_id"=>$key,"skor"=>array_sum($value)];
    	}

    	return $inventoryScores;
    }

   
}
