<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Security\EncryptController;
use App\Model\User;

use Request;
use Session;
use DB;

class HomeController extends Controller
{
    public function homeView() {
        // dd(Session::get('session_id'));
        // $user = User::get();
        // $id = $user[0]->name;
        // dd($id);
        $add = User::insert([
            'name' => 'ran',
            'email' => 'ran@gmail.com',
            'password' => '123',
            'name' => 'ran',
        ]);
        dd($add);
        return view('welcome')->with(['pageTitle' => 'Dashboard', 'title' => 'Dashboard', 'sidebar' => 'dashboard']);
        
    }

    public function getTransaksiBaruDashboard() {
        $req = new RequestController;

        date_default_timezone_set("Asia/Jakarta");
        // $transaction_startDate = date('2020-04-24');
        // $transaction_endDate = date('2020-04-24');
        $transaction_startDate = date('Y-m-d');
        $transaction_endDate = date('Y-m-d');

        $request = [
            "bank_code"                 => session('session_id.bank_code'),
            "merchant_code"             => session('session_id.merchant_code'),
            "summary_filter"            => 'unfiltered',
            // "transaction_date_start"    => $transaction_startDate,
            // "transaction_date_end"      => $transaction_endDate,
            // "status"                    => '',
            "order"                     => 'transaction_date_desc',
            "search"                    => '',
            "limit"                     => 5,
            "offset"                    => (int)Request::input('start'),
        ];
        // dd($request);
        $endPoint = '/trx_report/list';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);
        // dd($data);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        if (!isset($data['data'])) {
        	$data['data']['count'] = 0;
        	$data['data']['data'] = [];
        }

		$response = [
			"draw"=>Request::input('draw'),
			"recordsTotal"=> $data['data']['count'],
    		"recordsFiltered"=> $data['data']['count'],
            "data"=>$data['data']['data'],
            "summary"=>$data['data']['summary'],
        ];
        // dd($response);
		return response()->json($response);
    }

    public function listBank(){
        $bank = Bank::select('id', 'name')->get()->toArray();

        if ($bank != null) {
            return response()->json($bank);
        }else{
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mendapatkan Data Provinsi',
            ];
        }
    }

    public function changeBank(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        $beginCountingTime = microtime(true);

        $editBankIns = Institusi::where('id', session('session_id.id'))->update(['bank_id' => $data['jenisBank']]);

        if ($editBankIns) {
            session()->forget('session_id.bank_id');
            session()->forget('session_id.bank_code');

            $bank = Bank::where('id', $data['jenisBank'])->first();

            session()->put('session_id.bank_id', $data['jenisBank']);
            session()->put('session_id.bank_code', $bank->bank_code);

            $responseTime = microtime(true) - $beginCountingTime;

            $request = [
                'id' => session('session_id.id'),
                'bank_id' => $data['jenisBank'],
            ];

            $this->writeLog(
                Request::path(),
                Request::method(),
                app('Illuminate\Http\Response')->status(),
                $request,
                $editBankIns,
                $responseTime,
                Session::get('session_id.id'),
                Request::ip(),
                "change bank"
            );

            return response()->json([
                'status'   => 'success',
                'message'  => 'Berhasil mengubah data bank',
                'url'      => '/',
                'callback' => 'redirect'
            ]);
        }else{
             return response()->json([
                'status'   => 'error',
                'message'  => 'Gagal mengubah data bank',
            ]);
        }
    }

    public function changeProfilView(){
        return view('setting.setting')->with(['pageTitle' => 'Dashboard', 'title' => 'Dashboard', 'sidebar' => 'dashboard']);
    }

    public function editTelp(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        $beginCountingTime = microtime(true);

        $telpEdit = Institusi::where('id', session('session_id.id'))->update(['phone'=>$data['noTlpn']]);

        if ($telpEdit) {
            $responseTime = microtime(true) - $beginCountingTime;

            $request = [
                'id' => session('session_id.id'),
                'phone' => $data['noTlpn'],
            ];

            $this->writeLog(
                Request::path(),
                Request::method(),
                app('Illuminate\Http\Response')->status(),
                $request,
                $telpEdit,
                $responseTime,
                Session::get('session_id.id'),
                Request::ip(),
                "edit"
            );

            session()->forget('session_id.phone');
            session()->put('session_id.phone', $data['noTlpn']);
            return response()->json([
                'status'   => 'success',
                'message'  => 'Berhasil mengubah nomor telfon',
                'callback' => 'change-telfon'
            ]);
        }else{
             return response()->json([
                'status'   => 'error',
                'message'  => 'Gagal mengubah nomor telfon',
            ]);
        }
    }

    public function changePassView()
    {
        return view('setting.edit-password')->with(['pageTitle' => 'Dashboard', 'title' => 'Dashboard', 'sidebar' => 'dashboard']);
    }
    public function submitChangePass()
    {
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);

        $checkInstitusi = Institusi::where('id', session('session_id.id'))->select('password')->get()->toArray();
        if (md5($data['oldPass'].'v4Agr3g4t0R') == $checkInstitusi[0]['password']) {
            $email = session('session_id.email');
            $req = new RequestController;

            $request = [
                'email'      => $email,
                'type'       => 'change_password'
            ];

            $endpoint = '/password/generate';

            $beginCountingTime = microtime(true);

            $response = $req->send($request,$endpoint);

            $responseTime = microtime(true) - $beginCountingTime;

            $this->writeLog(
                Request::path(),
                Request::method(),
                app('Illuminate\Http\Response')->status(),
                $request,
                $response,
                $responseTime,
                Session::get('session_id.id'),
                Request::ip(),
                "change password"
            );

            if ($response['code'] == "00") {
                return [
                    'status'   => 'success',
                    'message'  => $response['message'],
                    'callback' => 'change-password',
                    'data'     => [
                                    'email'    => $email,
                                    'newPass'  => md5($data['newPass'].'v4Agr3g4t0R')
                                  ]
                ];
            } else {
                return [
                    'status'   => 'error',
                    'message'  => $response['message']
                ];
            }
        }else{
            return [
                'status'   => 'error',
                'message'  => 'Data tidak sesuai'
            ];
        }
    }

    public function submitAccOtp(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        $req = new RequestController;

        $request = [
            'email'      => $data['emailChange'],
            'password'   => $data['newPassChange'],
            'otp'        => $data['otpChange'],
        ];

        $endpoint = '/password/verify';

        $beginCountingTime = microtime(true);

        $response = $req->send($request,$endpoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $request = [
            'email' => $data['emailChange'],
            'password' => '***',
            'otp' => $data['otpChange']
        ];

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $response,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "submit otp"
        );

        if ($response['code'] == "00") {
            return [
                'status'   => 'success',
                'message'  => $response['message'],
                'url'      => '/setting',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => $response['message']
            ];
        }
    }

    public function changePic(){
        $req = new RequestController;
        $responseImage = null;

        if (Request::has('file')) {
            $image = Request::file('file');
            $imageRequest = [
                "image" => $image,
                "type" => 'user'
            ];

            $beginCountingTime = microtime(true);

            $responseImage = $req->sendImage($imageRequest);
            // dd($responseImage);
            $profilPic = $responseImage['image'];
            // if ($responseImage['code'] != "00") {
            //     return back()->with('response', [
            //         'status' => 'error',
            //         'message' => 'Gagal Upload Gambar',
            //     ]);
            // }else{
            //     $profilPic = $responseImage['data']['filename'];
            // }
        }else{
            $profilPic = "";
        }

        $editPic = Institusi::where('id', session('session_id.id'))->update(['picture'=>$profilPic]);

        $responseTime = microtime(true) - $beginCountingTime;

        $request = [
            'image' => $profilPic,
            'type' => "user",
            'id' => session('session_id.id'),
        ];

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $responseImage,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "edit"
        );

        if ($editPic) {
            session()->forget('session_id.picture');
            session()->put('session_id.picture', $profilPic);
            $messages = [
                'status' => 'success',
                'message' => 'Foto Profil Berhasil Diubah',
                'url' => 'close'
            ];
            return redirect('edit-profil')->with('notif', $messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => "Foto Profil Gagal Diubah",
                'url' => 'close'
            ];
            return redirect('edit-profil')->with('notif', $messages);
        }
    }

    public function grafikTrx() {
        if (Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));
            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }
        $req = new RequestController;

        $request = [
            "bank_code"                 => session('session_id.bank_code'),
            "merchant_code"             => session('session_id.merchant_code'),
            "summary_filter"            => $period,
        ];
        // dd($request);
        $endPoint = '/graph/count';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);
        // dd($data);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        return response()->json($data);
    }

    public function grafikStatusTrx() {
        if (Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));
            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }
        $req = new RequestController;

        $request = [
            "bank_code"                 => session('session_id.bank_code'),
            "merchant_code"             => session('session_id.merchant_code'),
            "summary_filter"            => $period,
        ];
        // dd($request);
        $endPoint = '/graph/status';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        // dd($data);
        return response()->json($data);
    }

    public function grafikIncome() {
        if (Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));
            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }
        // dd($period);
        $req = new RequestController;

        $request = [
            "bank_code"                 => session('session_id.bank_code'),
            "merchant_code"             => session('session_id.merchant_code'),
            "summary_filter"            => $period,
        ];
        // dd($request);
        $endPoint = '/graph/income';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);
        // dd($data);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        return response()->json($data);
    }

    public function getCardDataAdmin() {
        $req = new RequestController;;

        $request = [];

        $endPoint = '/graph/admin/card';

        $data = $req->send($request, $endPoint);

        return response()->json($data);
    }

    public function getDataRegisterBaruAdmin() {
        if(Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));

            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }

        $req = new RequestController;

        $request = [
            "summary_filter" => $period,
        ];

        $endPoint = '/graph/admin/register';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        return response()->json($data);
    }

    public function getDataUpgradeAccountAdmin() {
        if(Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));

            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }

        $req = new RequestController;

        $request = [
            "summary_filter" => $period,
        ];

        $endPoint = '/graph/admin/upgrade';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        return response()->json($data);
    }

    public function getDataTransaksiAdmin() {
        if(Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));

            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }

        $req = new RequestController;

        $request = [
            "summary_filter" => $period,
        ];

        $endPoint = '/graph/count';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        return response()->json($data);
    }

    public function getDataIncomeAdmin() {
        if(Request::input('period')) {
            $temp = base64_decode(urldecode(Request::input('period')));

            if ($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }

        $req = new RequestController;

        $request = [
            "summary_filter" => $period,
        ];

        $endPoint = '/graph/income';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        return response()->json($data);
    }

    public function getDataTransaksiByInstitusiAdmin() {
        if(Request::input('order')[0]['column'] == '0') {
            $column = 'name';
        } elseif (Request::input('order')[0]['column'] == '1') {
            $column = 'name';
        } elseif (Request::input('order')[0]['column'] == '2') {
            $column = 'transaksi';
        }

        if(Request::input('param')) {
            $temp = base64_decode(urldecode(Request::input('param')['period']));

            if($temp === 'mingguan') {
                $period = 'weekly';
            } elseif ($temp === 'bulanan') {
                $period = 'monthly';
            } elseif ($temp === 'tahunan') {
                $period = 'yearly';
            } else {
                $period = 'daily';
            }
        } else {
            $period = 'daily';
        }

        $order = $column.'_'.Request::input('order')[0]['dir'];

        if(Request::input('search')['value'] == null) {
            $search = NULL;
        } else {
            $search = Request::input('search')['value'];
        }

        $req = new RequestController;

        $request = [
            "order" => $order,
            $search == NULL ? "" : "search" => Request::input('search')['value'],
            "summary_filter" => $period,
            "limit" => intval(Request::input('length')),
            "offset" => intval(Request::input('start'))
        ];

        $endPoint = '/graph/table/income';

        $beginCountingTime = microtime(true);

        $data = $req->send($request, $endPoint);

        $responseTime = microtime(true) - $beginCountingTime;

        $request = [
            "order" => $order,
            "search" => Request::input('search')['value'] == NULL ? "null" : Request::input('search')['value'],
            "summary_filter" => $period,
            "limit" => intval(Request::input('length')),
            "offset" => intval(Request::input('start'))
        ];

        $this->writeLog(
            Request::path(),
            Request::method(),
            app('Illuminate\Http\Response')->status(),
            $request,
            $data,
            $responseTime,
            Session::get('session_id.id'),
            Request::ip(),
            "list"
        );

        $response = [
            "draw" => Request::input('draw'),
            "recordsTotal" => $data['data']['count'],
            "recordsFiltered" => $data['data']['count'],
            "data" => $data['data']['data'],
        ];

        return response()->json($response);
    }

    public function writeLog($url, $method, $status, $request, $response, $responseTime, $userId, $ipaddress, $tipe) {
        $log = new RequestController();

        if(session('session_id.priviledge_id') == "1") {
            $log->writeAdminLog($url, $method, $status, $request, $response, $responseTime, $userId, $ipaddress, $tipe);
        } else {
            $log->writeLog($url, $method, $status, $request, $response, $responseTime, $userId, $ipaddress);
        }
    }
}
