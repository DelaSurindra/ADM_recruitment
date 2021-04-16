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
use App\Model\SetTest;
use App\Model\Job_Application as JobApplication;
use App\Model\Status_History_Application as HistoryApplication;
use App\Model\MasterFacet;

class ScoringController extends Controller
{
    //
    public function submitTest(Request $request){
    	$validator = Validator::make($request->all(), [
    		"test_answers" => "required|array",
    		"test_participant_id" => "required",
            "vacancy_id" => "required",
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
        $cognitiveScoreGroup = $cognitiveScores["group"];
        unset($cognitiveScores["group"]);
    	CognitiveTestResult::insert($cognitiveScores);

        // Determine if the candidate are pass or not
        $isPassed = self::passingDetermination($testSet, $cognitiveScoreGroup);

        if($isPassed["code"]!="00"){
            return $isPassed;
        }
        // Update status job applicant
        $vacancyId = decrypt($request->vacancy_id);
        $kandidatId = $participant->kandidat_id;
        $jobApplication = JobApplication::where("kandidat_id",$kandidatId)
                                        ->where("vacancy_id",$vacancyId)
                                        ->orderBy("created_at","desc")
                                        ->get();
        if(sizeof($jobApplication)==0){
            return response()->json(["code"=>"32","message"=>"Job application not found"]);
        }

        $application = $jobApplication[0];

        if($isPassed["status"]){
            $status = 3;
        }else{
            $status = 4;
        }
        $application->status = $status;
        $application->save();

        // Insert status history applicant
        HistoryApplication::insert([
            "status" => $status,
            "job_application_id" => $application->id
        ]);

    	// Count inventory scores
    	$inventoryScores = self::countInventoryScores($inventoryAnswers, $participantId);

    	// Save inventory scores
    	InventoryTestResult::insert($inventoryScores);


    	// Update status test participant
    	$participant->status = 5;
    	$participant->save();
        
        // Delete id participant from inventory results
        foreach ($inventoryScores as $key => $value) {
                    unset($inventoryScores[$key]["id_participant"]);
                }    	

    	return response()->json([
            "code"=>"00","message"=>"Sukses submit test",
            "data"=>[
                "cognitve_scores"=>$isPassed["data"],
                "inventory_scores" => $inventoryScores,
                "is_passed" => $isPassed["status"]
            ]]);

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
    *@output array of congintive test results
        {
            "verbal1":10,
            "verbal2":10,
            "verbal3":10,
            "verbal4":10,
            "verbal5":10,
            "numercal1":10,
            "numercal2":10,
            "numercal3":10,
            "numercal4":10,
            "group":{
                "verbal":50,
                "numerical":40
            }
        }
    */
    protected function countCognitiveScore($testSet,$answers){
    	$questionKeys = self::getQuestionKeys($testSet);

    	$mappedQuestionKeys = self::mapArrayById($questionKeys);
    	$mappedAnswers = self::mapArrayById($answers);
    	// dd($mappedAnswers,$mappedQuestionKeys);
    	$answerScores = [];
  		$totalScore = 0;
    	foreach ($mappedQuestionKeys as $id => $_questionKey) {
    		$key = $_questionKey["answer_keys"];
    		$subType = strtolower(str_replace(" ", "", $_questionKey["sub_type"]));
            $subTypeGroup = strtolower(substr($_questionKey["sub_type"],0, strlen($_questionKey["sub_type"])-2));

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
    		$totalScore = $totalScore+$score;
            if(!isset($answerScores[$subType])){
                $answerScores[$subType] = $score;
            }else{
        		$answerScores[$subType] = $answerScores[$subType]+$score;
            }

            if(!isset($answerScores["group"][$subTypeGroup])){
                $answerScores["group"][$subTypeGroup] = $score;
            }else{
                $answerScores["group"][$subTypeGroup] = $answerScores["group"][$subTypeGroup]+$score;
            }
    	}

    	$answerScores["skor"] = $totalScore;
    	$answerScores["status"] = 1;   
        // dd($mappedQuestionKeys,$answerScores);
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
    *@output array of sum of test scores group by facet_id
        [
            {"id_participant":"1","facet_id":"1","skor":"12"},
            {"id_participant":"1","facet_id":"2","skor":"8"},
            {"id_participant":"1","facet_id":"3","skor":"8"},
        ]
    */

    protected function countInventoryScores($answers, $idParticipant){
    	$mappedAnswer = [];
    	foreach ($answers as $key => $value) {
    		# code...
    		$mappedAnswer[$value["facet_id"]][] = $value["score"];
    	}

    	$inventoryScores = [];

        $masetrFacet = MasterFacet::get();

    	foreach ($masetrFacet as $_facet) {
    		# code...
            $facetId = $_facet->id;
            if(isset($mappedAnswer[$facetId])){
        		$inventoryScores[] =["id_participant"=>$idParticipant, "facet_id"=>$facetId,"skor"=>array_sum($mappedAnswer[$facetId])];
            }else{
                $inventoryScores[] =["id_participant"=>$idParticipant, "facet_id"=>$facetId,"skor"=>0];
            }
    	}

    	return $inventoryScores;
    }

    protected function passingDetermination($testSet, $cognitiveScores){
        $masterData = SetTest::find($testSet);

        if(!$masterData){
            return ["code"=>"33","mmessage"=>"Master data untuk set test tidak ditemukan"];
        }

        $totalScore = array_sum($cognitiveScores);

        $isPassed = false;

        if($totalScore < $masterData["total"]){
            $isPassed = true;
            foreach ($cognitiveScores as $key => $value) {
                if($value < $masterData[$key]){
                    $isPassed = false;
                }
                $cognitiveScores[$key] = ["score"=>$value,"minimum_score"=>$masterData[$key],"is_passed"=>$isPassed];
            }
            $cognitiveScores["total"] = ["score"=>$totalScore,"minimum_score" => $masterData["total"],"is_passed" => false];
        }else{
            $isPassed = true;
            $cognitiveScores["total"] = ["score"=>$totalScore,"minimum_score" => $masterData["total"],"is_passed" => true];
        }

        return ["code"=>"00","status"=>$isPassed,"data"=>$cognitiveScores];
    }

   
}
