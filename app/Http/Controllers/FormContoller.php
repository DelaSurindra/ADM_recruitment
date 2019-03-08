<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\Vacancy;
use App\Model\Pelamar;
use App\Model\Setting;
use Exception;


class FormContoller extends Controller
{
    //
    private $vacancy;

    public function __construct(){
    	$this->vacancy = new Vacancy;
    }

    public function sliderIndex(Request $request)
    {
    	# code...
    	$vacancies = $this->vacancy->where('is_available',true)->get();
    	return view('slider')->with('positions',$vacancies);

    }

    public function form(Request $request, $job=null)
    {
    	if($job==null){
    		return redirect()->route('slider')->with('error_msg','Ops! Sepertinya posisi yang Kamu cari belum ada. Silakan pilih pekerjaan yang ada di bawah ini.');
    	}

    	$selectedJob = $this->vacancy->find($job);

    	if(empty($selectedJob)){
    		return redirect()->route('slider')->with('error_msg','Ops! Sepertinya posisi yang Kamu cari belum ada. Silakan pilih pekerjaan yang ada di bawah ini.');
    	}

    	$title = $selectedJob->job_title;
    	$request->session()->put('selectedJob', $selectedJob->job_id);
        $setting = Setting:: select()->first();
        $role= $setting->value;

    	return view('form')->with(['jobTitle'=>$title,'role' => $role]);
    }
    public function detail(Request $request, $job=null)
    {
        if($job==null){
            return redirect()->route('slider')->with('error_msg','Ops! Sepertinya posisi yang Kamu cari belum ada. Silakan pilih pekerjaan yang ada di bawah ini.');
        }

        $selectedJob = $this->vacancy->find($job);

        if(empty($selectedJob)){
            return redirect()->route('slider')->with('error_msg','Ops! Sepertinya posisi yang Kamu cari belum ada. Silakan pilih pekerjaan yang ada di bawah ini.');
        }

        $title = $selectedJob->job_title;

        $request->session()->put('selectedJob', $selectedJob->job_id);

        return view('detail')->with('data',$selectedJob);
    }

    public function submitLamaran(Request $request)
    {
    	if(!$request->session()->has('selectedJob')){
    		return redirect()->route('slider')->with('error_msg','Ops! Kamu terlalu lama mengisi formulir sehingga sesi kamu telah berakhir, silakan ulangi proses dari awal.');
    	}
    	$validator = Validator::make($request->all(), [
    		'firstname' => 'required',
			'lastname' => 'required',
			'tanggal_lahir' => 'required',
			'tempat_lahir' => 'required',
			'alamat' => 'required',
			'no_hp' => 'required',
			'email' => 'required|email|unique:pelamar',
			'kampus' => 'required',
			'jurusan' => 'required',
            'info'=>'required',
			'file_cv' => 'max:5000|mimes:pdf'
        ]);
        // dd($request);
        if ($validator->fails()) {
            return redirect()
            			->back()
                        ->with('error_msg',implode('<br>', ($validator->errors()->all())))
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasFile('file_cv')){

        	if(!$request->file('file_cv')->isValid()){
        		return redirect()->back()
        					->withInput()
        					->with('error_msg','Please upload valid file');
			}
			$filename = 'cv_'.$request->session()->get('selectedJob').'_'.$request->firstname.'_'.str_replace('-', '', $request->tanggal_lahir).'_'.date('Ymdhis').'.'.'pdf';
			$destination = 'public/cv';
			$cvPath = $request->file_cv->storeAs($destination,$filename);
            $request->file('file_cv')->move($destination,$filename);
        }
        $pelamar = new Pelamar;
        $pelamar->firstname = strip_tags($request->firstname);
		$pelamar->job_id = $request->session()->get('selectedJob');
        $pelamar->lastname = strip_tags($request->lastname);
        $pelamar->tanggal_lahir = strip_tags(date('Y-m-d',strtotime($request->tanggal_lahir)));
        $pelamar->tempat_lahir = strip_tags($request->tempat_lahir);
        $pelamar->alamat = strip_tags($request->alamat);
        $pelamar->no_hp = strip_tags($request->no_hp);
        $pelamar->email = strip_tags($request->email);
        $pelamar->kampus = strip_tags($request->kampus);
        $pelamar->jurusan = strip_tags($request->jurusan);
        $pelamar->info = strip_tags($request->info);
        $pelamar->file_cv =  isset($cvPath) ? $cvPath : null;
        
        // dd($pelamar);
        try {
            $pelamar->save();

            $request->session()->forget('selectedJob');
	        return redirect()->route('slider')
	        				->with('success_msg','Terimakasih sudah submit CV terbaikmu di Vascomm. We’ll update you soon.');
        } catch (Exception $e) {
        	return redirect()->back()
                            ->withInput()
	        				->with('error_msg','Oh Tidak! Sepertinya sistem sedang mengalami gangguan. Silaka laporkan gangguan dan coba beberapa saat lagi. Err: '.$e->getMessage());
        }

        
    }
}
