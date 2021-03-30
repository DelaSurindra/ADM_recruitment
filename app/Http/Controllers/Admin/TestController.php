<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Test;
use App\Model\AlternatifTest;
use App\Model\Wilayah;
use App\AdminSession;

use Hash;
use Request;
use Session;

class TestController extends Controller
{
    public function viewTest(){
        return view('admin.test.test-list')->with(['pageTitle' => 'Manajemen Test', 'title' => 'Manajemen Test', 'sidebar' => 'manajemen_test']);
    }

    public function listTest(){
        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );
        $test = new Test;
        if ($dataSend['search']){
            $test = $test->where('title','like','%'.$dataSend['search'].'%');
        }
        $countTest = $test->count();

        $listTest = $test->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));

        if ($dataSend["order"]) {
            $listTest = $listTest->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listTest = $listTest->orderBy('created_at', $dataSend["sort"])->get()->toArray();
        }
        
        if ($listTest != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countTest,
                "recordsFiltered"   => $countTest,
                "data"              => $listTest
            );
        }else{
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => 0,
                "recordsFiltered"   => 0,
                "data"              => []
            );
        }
        return $response;
    }

    public function viewTestAdd(){
        $breadcrumb = [
            "page"      => "Manage Test",
            "detail"    => "Create Test",
            "route"     => "/HR/test"
        ];
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        return view('admin.test.test-add')->with(['pageTitle' => 'Manajemen Test', 'title' => 'Manajemen Test', 'sidebar' => 'manajemen_test', 'wilayah'=>$wilayah, 'breadcrumb' => $breadcrumb]);
    }

    public function addTest(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        if (is_array($data['setTest'])) {
            $setTest = implode(",", $data['setTest']);
        }else{
            $setTest = $data['setTest'];
        }
        $city = strtoupper(substr($data['cityTest'], 0,3));
        $date = date('dmy', strtotime($data['dateTest']));
        $time = strtoupper(substr($data['timeTest'], 0,2));
        $rand = rand(pow(10, 3-1), pow(10, 3)-1);
        $testId = $city.$date.$time.$rand;

        $addTest = Test::insertGetId([
            "city" => $data['cityTest'],
            "time" => $data['timeTest'],
            "location" => $data['locationTest'],
            "date_test" => date("Y-m-d", strtotime($data['dateTest'])),
            "latlong" => $data['longlatTest'],
            "set_test" => $setTest,
            "status_test" => 0,
            "event_id" => $testId
        ]);

        if ($addTest) {
            if (isset($data['alternatifTest'])) {
                if (is_array($data['alternatifTest'])) {
                    for ($i=0; $i < count($data['alternatifTest']); $i++) { 
                        $addAlternatif = AlternatifTest::insert([
                            "date" => $data['alternatifTestDate'][$i],
                            "test_id" => $data['alternatifTest'][$i],
                            "alternative_test_id" => $data['alternatifTest'][$i]
                        ]);
                    }
                }else{
                    $addAlternatif = AlternatifTest::insert([
                        "date" => $data['alternatifTestDate'],
                        "test_id" => $data['alternatifTest'],
                        "alternative_test_id" => $data['alternatifTest']
                    ]);
                }
                if ($addAlternatif) {
                    $id = base64_encode(urlencode($addTest));
                    $messages = [
                        'url' => 'test/detail-test/'.$id
                    ];
        
                    return redirect('/HR/test')->with('addTest', $messages);
                }else{
                    $messages = [
                        'status' => 'error',
                        'message' => 'Create Test Failed',
                        'url' => 'close',
                        'id' => '',
                        'value' => ''
                    ];
        
                    return back()->with('notif', $messages);
                }
            }else{
                $id = base64_encode(urlencode($addTest));
                $messages = [
                    'url' => 'test/detail-test/'.$id
                ];
    
                return redirect('/HR/test')->with('addTest', $messages);
            }
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Create Test Failed',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        } 
        // dd($city, $date, $time, $rand, $testId);
    }
}
