<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Job_Application;
use App\Model\Candidate;
use App\Model\Education;
use App\Model\Wilayah;
use App\Model\User;
use App\Model\Vacancy;
use App\Model\Status_History_Application;
use App\Model\TestParticipant;
use App\Model\AlternatifTest;
use App\Model\InterviewEvent;
use App\Model\interviewReschedule;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;
use App\Jobs\JobSendEmail;
use Request;
use Session;
use Hash;

class ProfileController extends Controller
{
    public function viewFirstLogin(){
        // dd(Session::get('session_candidate'));
        if (session('session_candidate.telp') != null) {
            return redirect('/profile');
        } else {
            $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
            $universitas = MasterUniversitas::get()->toArray();
            $major = MasterMajor::get()->toArray();
            // dd($universitas,$major);
            return view('candidate.profile.first-login-candidate')->with(['topbar'=>'first_login', 'wilayah'=>$wilayah, 'univ' => $universitas, 'major' => $major]);
        }
    }

    public function postFirstLogin(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        
        // Photo Profile
        if (Request::has('photoProfile')) {
            $image = Request::file('photoProfile');
            $ext = $image->getClientOriginalExtension();    
            $path_photo_profile = $image->storeAs('photo-profile', 'photo_profile_'.time().'.'.$ext, 'public');
            // $sql->image_logo = $path; di db nggk ada kolomnya
        }else{
            $path_photo_profile = "";
        }
        // Cover Letter
        if (Request::has('coverLetter')) {
            $image = Request::file('coverLetter');
            $ext = $image->getClientOriginalExtension();    
            $path_cover_letter = $image->storeAs('cover-letter', 'cover_letter_'.time().'.'.$ext, 'public');
        } else {
            $path_cover_letter = $data['coverLetterLink'];
        }
        // Resume
        if (Request::has('resume')) {
            $image = Request::file('resume');
            $ext = $image->getClientOriginalExtension();    
            $path_resume = $image->storeAs('resume', 'resume_'.time().'.'.$ext, 'public');
        } else {
            $path_resume = $data['resumeLink'];
        }
        // Portofolio
        if (Request::has('portofolio')) {
            $image = Request::file('portofolio');
            $ext = $image->getClientOriginalExtension();    
            $path_portofolio = $image->storeAs('portofolio', 'portofolio_'.time().'.'.$ext, 'public');
        } else {
            $path_portofolio = $data['portofolioLink'];
        }

        $candidate = Candidate::where('id', $data['idCandidate'])->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'tanggal_lahir' => date('Y-m-d', strtotime($data['birthDate'])),
            'gender' => isset($data['gender']) ? $data['gender'] : null,
            'telp' => $data['phoneNumber'],
            'kota' => $data['myLocation'],
            'linkedin' => $data['lingkedInLink'],
            'cover_letter' => $path_cover_letter,
            'resume' => $path_resume,
            'protofolio' => $path_portofolio,
            'foto_profil' => $path_photo_profile,
            'skill' => $data['skill'],
        ]);

        if (Request::has('certificate')) {
            $image = Request::file('certificate');
            if (count($image) > 1) {
                for ($i=0; $i < count($image); $i++) {
                    $ext = $image[$i]->getClientOriginalExtension();
                    $path_certificate = $image[$i]->storeAs('certificate', 'certificate_'.time().'.'.$ext, 'public');
    
                    $education = new Education;
                    $education->universitas = $data['university'][$i];
                    $education->gelar = $data['degree'][$i];
                    $education->fakultas = $data['faculty'][$i];
                    $education->jurusan = $data['major'][$i];
                    $education->start_year = $data['startDateEducation'][$i];
                    $education->end_year = $data['endDateEducation'][$i];
                    $education->ijazah = $path_certificate;
                    $education->gpa = $data['gpa'][$i];
                    $education->kandidat_id = $data['idCandidate'];
                    $education->save();
                }
            } else {
                for ($i=0; $i < count($image); $i++) {
                    $ext = $image[$i]->getClientOriginalExtension();
                    $path_certificate = $image[$i]->storeAs('certificate', 'certificate_'.time().'.'.$ext, 'public');
                }

                $education = new Education;
                $education->universitas = $data['university'];
                $education->gelar = $data['degree'];
                $education->fakultas = $data['faculty'];
                $education->jurusan = $data['major'];
                $education->start_year = $data['startDateEducation'];
                $education->end_year = $data['endDateEducation'];
                $education->ijazah = $path_certificate;
                $education->gpa = $data['gpa'];
                $education->kandidat_id = $data['idCandidate'];
                $education->save();
            }
        }

        if ($candidate) {
            $id = session('session_candidate.user_id');
            Session::forget('session_candidate');
            $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $id)->first()->toArray();
            $education = Education::where('kandidat_id', $user['id'])->get()->toArray();
            // dd($user, $education);
            $session = [
                'user_id' => $user['user_id'],
                'user_email' => $user['email'],
                'user_type' => $user['type'],
                'user_status' => $user['status'],
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'tanggal_lahir' => $user['tanggal_lahir'],
                'gender' => $user['gender'],
                'telp' => $user['telp'],
                'kota' => $user['kota'],
                'linkedin' => $user['linkedin'],
                'cover_letter' => $user['cover_letter'],
                'resume' => $user['resume'],
                'protofolio' => $user['protofolio'],
                'skill' => $user['skill'],
                'foto_profil' => $user['foto_profil'],
                'pendidikan' => $education
            ];

            Session::put('session_candidate', $session);
            $messages = [
                'status' => 'success',
                'message' => 'Complete Account Success',
                'url' => 'close'
            ];

            return redirect('/')->with('profileSaved', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Complete Account Failed',
                'url' => 'close'
            ];

            return back()->with('notifModal', $messages);
        }
    }

    public function viewProfile(){
        $job_apply = Job_Application::select('job_application.*', 'vacancies.job_title', 'vacancies.type', 'vacancies.lokasi')
                                ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                ->where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
        for ($i=0; $i < count($job_apply); $i++) { 
            if($job_apply[$i]['status'] >= 0 && $job_apply[$i]['status'] < 11 && $job_apply[$i]['status'] > 12){
                if ($job_apply[$i]['status'] == 0) {
                    $job_apply[$i]['status_text'] = "Application Resume";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 1) {
                    $job_apply[$i]['status_text'] = "Proses to Written Test";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 2) {
                    $job_apply[$i]['status_text'] = "Check Online Test";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 3) {
                    $job_apply[$i]['status_text'] = "Written Test Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 4) {
                    $job_apply[$i]['status_text'] = "Written Test failed";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 5) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 6) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 7) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 8) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 9) {
                    $job_apply[$i]['status_text'] = "Check MCU";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 10) {
                    $job_apply[$i]['status_text'] = "Doc Sign";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 13) {
                    $job_apply[$i]['status_text'] = "HR interview Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 14) {
                    $job_apply[$i]['status_text'] = "HR interview Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 15) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 16) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 17) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 18) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 19) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 20) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 21) {
                    $job_apply[$i]['status_text'] = "MCU Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 22) {
                    $job_apply[$i]['status_text'] = "MCU Fail";
                    $job_apply[$i]['button'] = "N";
                }
                $job_apply[$i]['status_css'] = 'other';
            }elseif($job_apply[$i]['status'] == 11){
                $job_apply[$i]['status_text'] = "Failed";
                $job_apply[$i]['status_css'] = 'failed';
                $job_apply[$i]['button'] = "N";
            }else{
                $job_apply[$i]['status_text'] = "Hired";
                $job_apply[$i]['status_css'] = 'success';
                $job_apply[$i]['button'] = "N";
            }
        } 
        return view('candidate.profile.profile-child')->with(['topbar'=>'profile', 'tab_profile'=>'profile-home', 'job_apply'=>$job_apply]);
    }

    public function editPersonalInformation(){
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();

        $job_apply = Job_Application::select('job_application.*', 'vacancies.job_title', 'vacancies.type', 'vacancies.lokasi')
                                ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                ->where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
        for ($i=0; $i < count($job_apply); $i++) { 
            if($job_apply[$i]['status'] >= 0 && $job_apply[$i]['status'] < 11){
                if ($job_apply[$i]['status'] == 0) {
                    $job_apply[$i]['status_text'] = "Application Resume";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 1) {
                    $job_apply[$i]['status_text'] = "Proses to Written Test";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 2) {
                    $job_apply[$i]['status_text'] = "Scheduled to Written Test";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 3) {
                    $job_apply[$i]['status_text'] = "Written Test Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 4) {
                    $job_apply[$i]['status_text'] = "Written Test failed";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 5) {
                    $job_apply[$i]['status_text'] = "Process to HR interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 6) {
                    $job_apply[$i]['status_text'] = "Process to User Interview 1";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 7) {
                    $job_apply[$i]['status_text'] = "Process to User Interview 2";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 8) {
                    $job_apply[$i]['status_text'] = "Process to User Interview 3";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 9) {
                    $job_apply[$i]['status_text'] = "Process to MCU";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 10) {
                    $job_apply[$i]['status_text'] = "Process to Doc Sign";
                    $job_apply[$i]['button'] = "Y";
                }
                $job_apply[$i]['status_css'] = 'other';
            }elseif($job_apply[$i]['status'] == 11){
                $job_apply[$i]['status_text'] = "Failed";
                $job_apply[$i]['status_css'] = 'failed';
                $job_apply[$i]['button'] = "N";
            }else{
                $job_apply[$i]['status_text'] = "Hired";
                $job_apply[$i]['status_css'] = 'success';
                $job_apply[$i]['button'] = "N";
            }
        }

        return view('candidate.profile.personal-information')->with(['topbar'=>'personal_information', 'tab_profile'=>'profile-home', 'wilayah'=>$wilayah, 'job_apply'=>$job_apply]);
    }

    public function postEditPersonalInformation(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        // Photo Profile
        if (Request::has('photoProfile')) {
            $image = Request::file('photoProfile');
            $ext = $image->getClientOriginalExtension();    
            $path_photo_profile = $image->storeAs('photo-profile', 'photo_profile_'.time().'.'.$ext, 'public');
            // $sql->image_logo = $path; di db nggk ada kolomnya
        }else{
            $path_photo_profile = $data['oldImage'];
        }

        $candidate = Candidate::where('id', $data['idCandidate'])->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'tanggal_lahir' => date('Y-m-d', strtotime($data['birthDate'])),
            'gender' => isset($data['gender']) ? $data['gender'] : null,
            'telp' => $data['phoneNumber'],
            'kota' => $data['myLocation'],
            'foto_profil' => $path_photo_profile,
            'linkedin' => $data['lingkedInLink'],
        ]);

        if ($candidate) {
            $id = session('session_candidate.user_id');
            Session::forget('session_candidate');
            $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $id)->first()->toArray();
            $education = Education::where('kandidat_id', $user['id'])->get()->toArray();
            
            $session = [
                'user_id' => $user['user_id'],
                'user_email' => $user['email'],
                'user_type' => $user['type'],
                'user_status' => $user['status'],
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'tanggal_lahir' => $user['tanggal_lahir'],
                'gender' => $user['gender'],
                'telp' => $user['telp'],
                'kota' => $user['kota'],
                'linkedin' => $user['linkedin'],
                'cover_letter' => $user['cover_letter'],
                'resume' => $user['resume'],
                'protofolio' => $user['protofolio'],
                'skill' => $user['skill'],
                'foto_profil' => $user['foto_profil'],
                'pendidikan' => $education
            ];

            Session::put('session_candidate', $session);
            $messages = [
                'status' => 'success',
                'message' => 'Success Edit Personal Information',
                'url' => 'close'
            ];

            return redirect('/profile')->with('notifModal', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Failed Edit Personal Information',
                'url' => 'close'
            ];

            return back()->with('notifModal', $messages);
        }
    }

    public function editOtherInformation(){
        $job_apply = Job_Application::select('job_application.*', 'vacancies.job_title', 'vacancies.type', 'vacancies.lokasi')
                                ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                ->where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
        for ($i=0; $i < count($job_apply); $i++) { 
            if($job_apply[$i]['status'] >= 0 && $job_apply[$i]['status'] < 11 && $job_apply[$i]['status'] > 12){
                if ($job_apply[$i]['status'] == 0) {
                    $job_apply[$i]['status_text'] = "Application Resume";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 1) {
                    $job_apply[$i]['status_text'] = "Proses to Written Test";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 2) {
                    $job_apply[$i]['status_text'] = "Check Online Test";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 3) {
                    $job_apply[$i]['status_text'] = "Written Test Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 4) {
                    $job_apply[$i]['status_text'] = "Written Test failed";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 5) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 6) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 7) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 8) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 9) {
                    $job_apply[$i]['status_text'] = "Check MCU";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 10) {
                    $job_apply[$i]['status_text'] = "Doc Sign";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 13) {
                    $job_apply[$i]['status_text'] = "HR interview Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 14) {
                    $job_apply[$i]['status_text'] = "HR interview Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 15) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 16) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 17) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 18) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 19) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 20) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 21) {
                    $job_apply[$i]['status_text'] = "MCU Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 22) {
                    $job_apply[$i]['status_text'] = "MCU Fail";
                    $job_apply[$i]['button'] = "N";
                }
                $job_apply[$i]['status_css'] = 'other';
            }elseif($job_apply[$i]['status'] == 11){
                $job_apply[$i]['status_text'] = "Failed";
                $job_apply[$i]['status_css'] = 'failed';
                $job_apply[$i]['button'] = "N";
            }else{
                $job_apply[$i]['status_text'] = "Hired";
                $job_apply[$i]['status_css'] = 'success';
                $job_apply[$i]['button'] = "N";
            }
        } 

        return view('candidate.profile.other-information')->with(['topbar'=>'other_information', 'tab_profile'=>'profile-home', 'job_apply'=>$job_apply]);
    }

    public function postEditOtherInformation(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, Request::all());

        // Cover Letter
        if (Request::has('coverLetter')) {
            $image = Request::file('coverLetter');
            $ext = $image->getClientOriginalExtension();    
            $path_cover_letter = $image->storeAs('cover-letter', 'cover_letter_'.time().'.'.$ext, 'public');
        } else {
            $path_cover_letter = $data['coverLetterLink'];
        }
        // Resume
        if (Request::has('resume')) {
            $image = Request::file('resume');
            $ext = $image->getClientOriginalExtension();    
            $path_resume = $image->storeAs('resume', 'resume_'.time().'.'.$ext, 'public');
        } else {
            $path_resume = $data['resumeLink'];
        }
        // Portofolio
        if (Request::has('portofolio')) {
            $image = Request::file('portofolio');
            $ext = $image->getClientOriginalExtension();    
            $path_portofolio = $image->storeAs('portofolio', 'portofolio_'.time().'.'.$ext, 'public');
        } else {
            $path_portofolio = $data['portofolioLink'];
        }

        $candidate = Candidate::where('id', $data['idCandidate'])->update([
            'cover_letter' => $path_cover_letter,
            'resume' => $path_resume,
            'protofolio' => $path_portofolio,
            'skill' => $data['skill'],
        ]);

        if ($candidate) {
            $id = session('session_candidate.user_id');
            Session::forget('session_candidate');
            $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $id)->first()->toArray();
            $education = Education::where('kandidat_id', $user['id'])->get()->toArray();
            
            $session = [
                'user_id' => $user['user_id'],
                'user_email' => $user['email'],
                'user_type' => $user['type'],
                'user_status' => $user['status'],
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'tanggal_lahir' => $user['tanggal_lahir'],
                'gender' => $user['gender'],
                'telp' => $user['telp'],
                'kota' => $user['kota'],
                'linkedin' => $user['linkedin'],
                'cover_letter' => $user['cover_letter'],
                'resume' => $user['resume'],
                'protofolio' => $user['protofolio'],
                'skill' => $user['skill'],
                'foto_profil' => $user['foto_profil'],
                'pendidikan' => $education
            ];

            Session::put('session_candidate', $session);
            
            $messages = [
                'status' => 'success',
                'message' => 'Success Edit Other Information',
                'url' => 'close'
            ];

            return redirect('/profile')->with('notifModal', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Failed Edit Other Information',
                'url' => 'close'
            ];

            return back()->with('notifModal', $messages);
        }
    }

    public function editEducationInformation(){
        $job_apply = Job_Application::select('job_application.*', 'vacancies.job_title', 'vacancies.type', 'vacancies.lokasi')
                                ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                ->where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
        
        for ($i=0; $i < count($job_apply); $i++) { 
            if($job_apply[$i]['status'] >= 0 && $job_apply[$i]['status'] < 11 && $job_apply[$i]['status'] > 12){
                if ($job_apply[$i]['status'] == 0) {
                    $job_apply[$i]['status_text'] = "Application Resume";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 1) {
                    $job_apply[$i]['status_text'] = "Proses to Written Test";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 2) {
                    $job_apply[$i]['status_text'] = "Check Online Test";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 3) {
                    $job_apply[$i]['status_text'] = "Written Test Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 4) {
                    $job_apply[$i]['status_text'] = "Written Test failed";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 5) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 6) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 7) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 8) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 9) {
                    $job_apply[$i]['status_text'] = "Check MCU";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 10) {
                    $job_apply[$i]['status_text'] = "Doc Sign";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 13) {
                    $job_apply[$i]['status_text'] = "HR interview Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 14) {
                    $job_apply[$i]['status_text'] = "HR interview Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 15) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 16) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 17) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 18) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 19) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 20) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 21) {
                    $job_apply[$i]['status_text'] = "MCU Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 22) {
                    $job_apply[$i]['status_text'] = "MCU Fail";
                    $job_apply[$i]['button'] = "N";
                }
                $job_apply[$i]['status_css'] = 'other';
            }elseif($job_apply[$i]['status'] == 11){
                $job_apply[$i]['status_text'] = "Failed";
                $job_apply[$i]['status_css'] = 'failed';
                $job_apply[$i]['button'] = "N";
            }else{
                $job_apply[$i]['status_text'] = "Hired";
                $job_apply[$i]['status_css'] = 'success';
                $job_apply[$i]['button'] = "N";
            }
        } 

        $universitas = MasterUniversitas::get()->toArray();
        $major = MasterMajor::get()->toArray();

        return view('candidate.profile.education-information')->with(['topbar'=>'education_information', 'tab_profile'=>'profile-home', 'univ' => $universitas, 'major' => $major, 'job_apply'=>$job_apply]);
    }

    public function postEditEducationInformation(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, Request::file('certificate'));

        if (Request::has('certificate')) {
            $temp = [];
            $image = Request::file('certificate');
            foreach ($image as $key => $value) {
                $ext = $value->getClientOriginalExtension();
                $path_certificate = $value->storeAs('certificate', 'certificate_'.$key.time().'.'.$ext, 'public');

                $temp[$key] = $path_certificate;
            }
            // dd($temp);
            if (is_array($data['idEducation']) && count($data['idEducation']) > 1) {
                for ($i=0; $i < count($data['idEducation']); $i++) { 
                    if (!empty($data['idEducation'][$i])) {
                        $sql = Education::where('id', $data['idEducation'][$i])->first();
                        $sql->universitas = $data['university'][$i];
                        $sql->gelar = $data['degree'][$i];
                        $sql->fakultas = $data['faculty'][$i];
                        $sql->jurusan = $data['major'][$i];
                        $sql->start_year = $data['startDateEducation'][$i];
                        $sql->end_year = $data['endDateEducation'][$i];
                        $sql->gpa = $data['gpa'][$i];
                        $sql->kandidat_id = $data['idCandidate'];
                        if (isset($temp[$i])) {
                            $sql->ijazah = $temp[$i];
                        }
                        $sql->save();
                    } else {
                        $sql = new Education;
                        $sql->universitas = $data['university'][$i];
                        $sql->gelar = $data['degree'][$i];
                        $sql->fakultas = $data['faculty'][$i];
                        $sql->jurusan = $data['major'][$i];
                        $sql->start_year = $data['startDateEducation'][$i];
                        $sql->end_year = $data['endDateEducation'][$i];
                        $sql->gpa = $data['gpa'][$i];
                        $sql->kandidat_id = $data['idCandidate'];
                        if (isset($temp[$i])) {
                            $sql->ijazah = $temp[$i];
                        }
                        $sql->save();
                    }
                }
            } else {
                for ($i=0; $i < count($temp); $i++) {
                    if (!empty($data['idEducation'])) {
                        $sql = Education::where('id', $data['idEducation'])->first();
                        $sql->universitas = $data['university'];
                        $sql->gelar = $data['degree'];
                        $sql->fakultas = $data['faculty'];
                        $sql->jurusan = $data['major'];
                        $sql->start_year = $data['startDateEducation'];
                        $sql->end_year = $data['endDateEducation'];
                        $sql->gpa = $data['gpa'];
                        $sql->kandidat_id = $data['idCandidate'];
                        if (isset($temp[$i])) {
                            $sql->ijazah = $temp[$i];
                        }
                        $sql->save();
                    } else {
                        $sql = new Education;
                        $sql->universitas = $data['university'];
                        $sql->gelar = $data['degree'];
                        $sql->fakultas = $data['faculty'];
                        $sql->jurusan = $data['major'];
                        $sql->start_year = $data['startDateEducation'];
                        $sql->end_year = $data['endDateEducation'];
                        $sql->gpa = $data['gpa'];
                        $sql->kandidat_id = $data['idCandidate'];
                        if (isset($temp[$i])) {
                            $sql->ijazah = $temp[$i];
                        }
                        $sql->save();
                    }
                }
            }
        } else {
            if (is_array($data['idEducation']) && count($data['idEducation']) > 1) {
                for ($i=0; $i < count($data['idEducation']); $i++) { 
                    if (!empty($data['idEducation'][$i])) {
                        $sql = Education::where('id', $data['idEducation'][$i])->update([
                            'universitas' => $data['university'][$i],
                            'gelar' => $data['degree'][$i],
                            'fakultas' => $data['faculty'][$i],
                            'jurusan' => $data['major'][$i],
                            'start_year' => $data['startDateEducation'][$i],
                            'end_year' => $data['endDateEducation'][$i],
                            'gpa' => $data['gpa'][$i],
                            'kandidat_id' => $data['idCandidate'],
                        ]);
                    } else {
                        $sql = Education::insert([
                            'universitas' => $data['university'][$i],
                            'gelar' => $data['degree'][$i],
                            'fakultas' => $data['faculty'][$i],
                            'jurusan' => $data['major'][$i],
                            'start_year' => $data['startDateEducation'][$i],
                            'end_year' => $data['endDateEducation'][$i],
                            'gpa' => $data['gpa'][$i],
                            'kandidat_id' => $data['idCandidate'],
                        ]);
                    }
                }
            } else {
                if (!empty($data['idEducation'])) {
                    $sql = Education::where('id', $data['idEducation'])->update([
                        'universitas' => $data['university'],
                        'gelar' => $data['degree'],
                        'fakultas' => $data['faculty'],
                        'jurusan' => $data['major'],
                        'start_year' => $data['startDateEducation'],
                        'end_year' => $data['endDateEducation'],
                        'gpa' => $data['gpa'],
                        'kandidat_id' => $data['idCandidate'],
                    ]);
                } else {
                    $sql = Education::insert([
                        'universitas' => $data['university'],
                        'gelar' => $data['degree'],
                        'fakultas' => $data['faculty'],
                        'jurusan' => $data['major'],
                        'start_year' => $data['startDateEducation'],
                        'end_year' => $data['endDateEducation'],
                        'gpa' => $data['gpa'],
                        'kandidat_id' => $data['idCandidate'],
                    ]);
                }
            }
        }
        
        if ($sql) {
            $id = session('session_candidate.user_id');
            Session::forget('session_candidate');
            $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $id)->first()->toArray();
            $education = Education::where('kandidat_id', $user['id'])->get()->toArray();
            
            $session = [
                'user_id' => $user['user_id'],
                'user_email' => $user['email'],
                'user_type' => $user['type'],
                'user_status' => $user['status'],
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'tanggal_lahir' => $user['tanggal_lahir'],
                'gender' => $user['gender'],
                'telp' => $user['telp'],
                'kota' => $user['kota'],
                'linkedin' => $user['linkedin'],
                'cover_letter' => $user['cover_letter'],
                'resume' => $user['resume'],
                'protofolio' => $user['protofolio'],
                'skill' => $user['skill'],
                'foto_profil' => $user['foto_profil'],
                'pendidikan' => $education
            ];

            Session::put('session_candidate', $session);

            $messages = [
                'status' => 'success',
                'message' => 'Success Edit Education Information',
                'url' => 'close'
            ];

            return redirect('/profile')->with('notifModal', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Failed Edit Education Information',
                'url' => 'close'
            ];

            return back()->with('notifModal', $messages);
        }
    }

    public function viewEditPassword(){
        $job_apply = Job_Application::select('job_application.*', 'vacancies.job_title', 'vacancies.type', 'vacancies.lokasi')
                                ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                ->where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
        for ($i=0; $i < count($job_apply); $i++) { 
            if($job_apply[$i]['status'] >= 0 && $job_apply[$i]['status'] < 11 && $job_apply[$i]['status'] > 12){
                if ($job_apply[$i]['status'] == 0) {
                    $job_apply[$i]['status_text'] = "Application Resume";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 1) {
                    $job_apply[$i]['status_text'] = "Proses to Written Test";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 2) {
                    $job_apply[$i]['status_text'] = "Check Online Test";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 3) {
                    $job_apply[$i]['status_text'] = "Written Test Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 4) {
                    $job_apply[$i]['status_text'] = "Written Test failed";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 5) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 6) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 7) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 8) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 9) {
                    $job_apply[$i]['status_text'] = "Check MCU";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 10) {
                    $job_apply[$i]['status_text'] = "Doc Sign";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 13) {
                    $job_apply[$i]['status_text'] = "HR interview Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 14) {
                    $job_apply[$i]['status_text'] = "HR interview Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 15) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 16) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 17) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 18) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 19) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 20) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 21) {
                    $job_apply[$i]['status_text'] = "MCU Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 22) {
                    $job_apply[$i]['status_text'] = "MCU Fail";
                    $job_apply[$i]['button'] = "N";
                }
                $job_apply[$i]['status_css'] = 'other';
            }elseif($job_apply[$i]['status'] == 11){
                $job_apply[$i]['status_text'] = "Failed";
                $job_apply[$i]['status_css'] = 'failed';
                $job_apply[$i]['button'] = "N";
            }else{
                $job_apply[$i]['status_text'] = "Hired";
                $job_apply[$i]['status_css'] = 'success';
                $job_apply[$i]['button'] = "N";
            }
        } 

        return view('candidate.profile.education-information')->with(['topbar'=>'education_information', 'tab_profile'=>'profile-password', 'job_apply'=>$job_apply]);
    }

    public function postEditPassword(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        $pass = User::where('id', Session::get('session_candidate')['user_id'])->where('type', '1')->first();

        if (Hash::check($data['oldPassword'].env('SALT_PASS_CANDIDATE'), $pass->password)) {
            
            $update = User::where('id', Session::get('session_candidate')['user_id'])->update([
                'password' => bcrypt($data['newPasswordConfirm'].env('SALT_PASS_CANDIDATE'))
            ]);
    
            if ($update) {
                return [
                    'status'   => 'success',
                    'message'  => 'Change Password Success',
                    'url'      => '/',
                    'callback' => 'modal'
                ];
            }else{
                return [
                    'status'   => 'warning',
                    'message'  => 'Change Password Failed',
                ];
            }
        } else {
            return [
                'status'   => 'warning',
                'message'  => 'Old Password does not Match',
            ];
        }
    }

    public function myApp(){
        $job_apply = Job_Application::select('job_application.*', 'vacancies.job_title', 'vacancies.type', 'vacancies.lokasi')
                                ->join('vacancies', 'job_application.vacancy_id', 'vacancies.job_id')
                                ->where('kandidat_id', Session::get('session_candidate')['id'])->get()->toArray();
        for ($i=0; $i < count($job_apply); $i++) { 
            if($job_apply[$i]['status'] >= 0 || $job_apply[$i]['status'] < 11 || $job_apply[$i]['status'] > 12){
                if ($job_apply[$i]['status'] == 0) {
                    $job_apply[$i]['status_text'] = "Application Resume";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 1) {
                    $job_apply[$i]['status_text'] = "Proses to Written Test";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 2) {
                    $job_apply[$i]['status_text'] = "Check Online Test";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 3) {
                    $job_apply[$i]['status_text'] = "Written Test Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 4) {
                    $job_apply[$i]['status_text'] = "Written Test failed";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 5) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 6) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 7) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 8) {
                    $job_apply[$i]['status_text'] = "Check Interview";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 9) {
                    $job_apply[$i]['status_text'] = "Check MCU";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 10) {
                    $job_apply[$i]['status_text'] = "Doc Sign";
                    $job_apply[$i]['button'] = "Y";
                }elseif ($job_apply[$i]['status'] == 13) {
                    $job_apply[$i]['status_text'] = "HR interview Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 14) {
                    $job_apply[$i]['status_text'] = "HR interview Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 15) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 16) {
                    $job_apply[$i]['status_text'] = "User Interview 1 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 17) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 18) {
                    $job_apply[$i]['status_text'] = "User Interview 2 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 19) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 20) {
                    $job_apply[$i]['status_text'] = "User Interview 3 Fail";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 21) {
                    $job_apply[$i]['status_text'] = "MCU Pass";
                    $job_apply[$i]['button'] = "N";
                }elseif ($job_apply[$i]['status'] == 22) {
                    $job_apply[$i]['status_text'] = "MCU Fail";
                    $job_apply[$i]['button'] = "N";
                }
                $job_apply[$i]['status_css'] = 'other';
            }elseif($job_apply[$i]['status'] == 11){
                $job_apply[$i]['status_text'] = "Failed";
                $job_apply[$i]['status_css'] = 'failed';
                $job_apply[$i]['button'] = "N";
            }else{
                $job_apply[$i]['status_text'] = "Hired";
                $job_apply[$i]['status_css'] = 'success';
                $job_apply[$i]['button'] = "N";
            }
        }   
        // dd($job_apply);
        return view('candidate.profile.profile-child')->with(['topbar'=>'myapp_detail', 'tab_profile'=>'profile-applican', 'job_apply'=>$job_apply]);
    }
    public function myAppDetail($id){
        // $ins = Status_History_Application::insert(['status' => 0, 'job_application_id'=> 2]);
        // dd($ins);
        $idJob = base64_decode(urldecode($id));
        $job_apply = Job_Application::where('id', $idJob)->get()->toArray();
        if ($job_apply) {
            $test = TestParticipant::select('test_event.*', 'test_participant.id as id_participant', 'test_participant.kandidat_id', 'test_participant.test_id', 'test_participant.status as status_participant')
                                    ->where('kandidat_id', session('session_candidate.id'))
                                    ->join('test_event', 'test_event.id', 'test_participant.test_id')
                                    ->get()->toArray();
            if ($test) {
                // dd($test, $job_apply, $interview);
                $interview = InterviewEvent::where('id_job_application', $job_apply[0]['id'])->orderBy('created_at', 'DESC')->limit(1)->get()->toArray();
                $vacancy = Vacancy::where('job_id', $job_apply[0]['vacancy_id'])->get()->toArray();
                if ($vacancy) {
                    $history = Status_History_Application::where('job_application_id', $job_apply[0]['id'])->get()->toArray();
                    $apply = [];
                    $online_test = [];
                    $hr_interview = [];
                    $user_interview1 = [];
                    $user_interview2 = [];
                    $user_interview3 = [];
                    $mcu = [];
                    $document_sign = [];

                    $status_online_test = '';
                    $status_hr_interview = '';
                    $status_user_interview1 = '';
                    $status_user_interview2 = '';
                    $status_user_interview3 = '';
                    $status_mcu = '';

                    if ($history) {
                        $last = last($history);
                        $last_update = date("d F Y H:i", strtotime($last['created_at']));
                        // dd($history);
                        for ($i=0; $i < count($history) ; $i++) { 
                            $history[$i]['tanggal'] = date("d F Y H:i", strtotime($history[$i]['created_at']));
                            if ($history[$i]['status'] == "0") {
                                array_push($apply, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "1") {
                                array_push($online_test, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "2") {
                                array_push($online_test, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "3") {
                                array_push($online_test, $history[$i]['tanggal']);
                                $status_online_test = 'success';
                            }else if ($history[$i]['status'] == "4") {
                                array_push($online_test, $history[$i]['tanggal']);
                                $status_online_test = 'failed';
                            }else if ($history[$i]['status'] == "5") {
                                array_push($hr_interview, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "6") {
                                array_push($user_interview1, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "7") {
                                array_push($user_interview2, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "8") {
                                array_push($user_interview3, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "9") {
                                array_push($mcu, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "10") {
                                array_push($document_sign, $history[$i]['tanggal']);
                            }else if ($history[$i]['status'] == "13") {
                                array_push($hr_interview, $history[$i]['tanggal']);
                                $status_hr_interview = 'success';
                            }else if ($history[$i]['status'] == "14") {
                                array_push($hr_interview, $history[$i]['tanggal']);
                                $status_hr_interview = 'failed';
                            }else if ($history[$i]['status'] == "15") {
                                array_push($user_interview1, $history[$i]['tanggal']);
                                $status_user_interview1 = 'success';
                            }else if ($history[$i]['status'] == "16") {
                                array_push($user_interview1, $history[$i]['tanggal']);
                                $status_user_interview1 = 'failed';
                            }else if ($history[$i]['status'] == "17") {
                                array_push($user_interview2, $history[$i]['tanggal']);
                                $status_user_interview2 = 'success';
                            }else if ($history[$i]['status'] == "18") {
                                array_push($user_interview2, $history[$i]['tanggal']);
                                $status_user_interview2 = 'failed';
                            }else if ($history[$i]['status'] == "19") {
                                array_push($user_interview3, $history[$i]['tanggal']);
                                $status_user_interview3 = 'success';
                            }else if ($history[$i]['status'] == "20") {
                                array_push($user_interview3, $history[$i]['tanggal']);
                                $status_user_interview3 = 'failed';
                            }else if ($history[$i]['status'] == "21") {
                                array_push($mcu, $history[$i]['tanggal']);
                                $status_mcu = 'success';
                            }else if ($history[$i]['status'] == "22") {
                                array_push($mcu, $history[$i]['tanggal']);
                                $status_mcu = 'failed';
                            }
                        }
                    }else{
                        $last_update = '';
                    }
                    // dd($history);
                    return view('candidate.profile.my-app-detail')->with([
                        'topbar'=>'myapp_detail',
                        'tab_profile'=>'profile-applican',
                        'vacancy'=>$vacancy[0],
                        'history'=>[
                            'last_update'    => $last_update,
                            'apply'          => $apply,
                            'online_test'    => $online_test,
                            'hr_interview'   => $hr_interview,
                            'user_interview1'=> $user_interview1,
                            'user_interview2'=> $user_interview2,
                            'user_interview3'=> $user_interview3,
                            'mcu'            => $mcu,
                            'document_sign'  => $document_sign
                        ],
                        'status' => [
                            'status_online_test'     => $status_online_test,
                            'status_hr_interview'    => $status_hr_interview,
                            'status_user_interview1' => $status_user_interview1,
                            'status_user_interview2' => $status_user_interview2,
                            'status_user_interview3' => $status_user_interview3,
                            'status_mcu'             => $status_mcu
                        ],
                        'job' => $job_apply[0],
                        'test' => $test[0],
                        'interview' => $interview
                    ]);
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
            
        } else {
            abort(404);
        }
        
    }

    public function postConfirmTest(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        $confirmTest = TestParticipant::where('id', $data['idParticipant'])->update(['status' => 1]);
        if ($confirmTest) {
            $dataEmail = [
                'email'         => session('session_candidate.user_email'),
                'nama'          => session('session_candidate.first_name').' '.session('session_candidate.last_name'),
                'subject'       => 'Written Test Attendance Confirmed',
                'view'          => 'email.email-written-test-attendance'
            ];
    
            $response = JobSendEmail::dispatch($dataEmail);
            
            $id = base64_encode(urlencode($data["idJob"]));
            $messages = [
                'status' => 'success',
                'message' => 'Confirm Test Success',
                'url' => '/profile/my-app-detail/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Confirm Test Failed',
            ];

            return response()->json($messages);
        }
        
    }

    public function testReschedule($id){
        $idJob = base64_decode(urldecode($id));
        $job_apply = Job_Application::where('id', $idJob)->get()->toArray();
        // dd($job_apply);
        if ($job_apply) {
            $test = TestParticipant::select('test_event.*', 'test_participant.id as id_participant', 'test_participant.kandidat_id', 'test_participant.test_id', 'test_participant.status as status_participant')
                                    ->where('kandidat_id', session('session_candidate.id'))
                                    ->join('test_event', 'test_event.id', 'test_participant.test_id')
                                    ->get()->toArray();
            if ($test) {
                $alternatif = AlternatifTest::select('alternative_test_event.*', 'test_event.time')->join('test_event', 'test_event.id', 'alternative_test_event.alternative_test_id')->where('test_id', $test[0]['id'])->get()->toArray();
                $vacancy = Vacancy::where('job_id', $job_apply[0]['vacancy_id'])->get()->toArray();
                if ($vacancy) {
                    // dd($job_apply, $test, $vacancy, $alternatif);
                    return view('candidate.profile.test-reschedule')->with([
                        'topbar'=>'test_reschedule',
                        'job' => $job_apply[0],
                        'test' => $test[0],
                        'vacancy' => $vacancy[0],
                        'alternatif' => $alternatif,
                    ]);
                } else {
                    abort(404);
                }
                
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
        
    }

    public function postRescheduleTest(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $testParticipant = TestParticipant::where('id', $data['idParticipant'])->get()->toArray();
        if ($data['idReschedule'] != "") {
            if ($testParticipant) {
                if ($testParticipant[0]['reshedule_count'] < 4) {
                    $count = $testParticipant[0]['reshedule_count']+1;
                    $reschedule = TestParticipant::where('id', $data['idParticipant'])->update([
                        "status" => 2,
                        "reshedule_count" => $count,
                        "reshedule_test_id" => $data['idReschedule']
                    ]);
                    if ($reschedule) {
                        $id = base64_encode(urlencode($data["idJob"]));
                        $messages = [
                            'status' => 'success',
                            'message' => 'Reschedule Test Success',
                            'url' => '/profile/my-app-detail/'.$id,
                            'callback' => 'redirect'
                        ];

                        return response()->json($messages);
                    } else {
                        $messages = [
                            'status' => 'error',
                            'message' => 'Reschedule Test Failed',
                        ];
            
                        return response()->json($messages);
                    }
                    
                } else {
                    $messages = [
                        'status' => 'error',
                        'message' => 'Cannot Reschedule more than 3 times',
                    ];
        
                    return response()->json($messages);
                }
                
            } else {
                $messages = [
                    'status' => 'error',
                    'message' => 'Data Not Found',
                ];
    
                return response()->json($messages);
            }
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Please choose one schedule',
            ];

            return response()->json($messages);
        }
        
    }

    public function postRescheduleWt(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        $messages = [
            'status' => 'error',
            'message' => 'Access Not Permited',
        ];

        return response()->json($messages);
    }

    public function postConfirmInterview(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        $confirmTest = InterviewEvent::where('id', $data['idInterview'])->update(['status' => 6]);
        if ($confirmTest) {
            $id = base64_encode(urlencode($data["idJob"]));
            $messages = [
                'status' => 'success',
                'message' => 'Confirm Interview Success',
                'url' => '/profile/my-app-detail/'.$id,
                'callback' => 'redirect'
            ];

            return response()->json($messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Confirm Interview Failed',
            ];

            return response()->json($messages);
        }
        
    }

    public function interviewReschedule($id){
        $idJob = base64_decode(urldecode($id));
        $job_apply = Job_Application::where('id', $idJob)->get()->toArray();
        // dd($job_apply);
        if ($job_apply) {
            $interview = InterviewEvent::where('id_job_application', $job_apply[0]['id'])->orderBy('created_at', 'DESC')->limit(1)->get()->toArray();
            if ($interview) {
                $vacancy = Vacancy::where('job_id', $job_apply[0]['vacancy_id'])->get()->toArray();
                if ($vacancy) {
                    // dd($job_apply, $test, $vacancy, $alternatif);
                    return view('candidate.profile.interview-reschedule')->with([
                        'topbar'=>'test_reschedule',
                        'job' => $job_apply[0],
                        'interview' => $interview[0],
                        'vacancy' => $vacancy[0]
                    ]);
                } else {
                    abort(404);
                }
                
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function postRescheduleInterview(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        if ($data['countInterview'] < 4) {
            $insertReschedule = interviewReschedule::insert([
                "interview_event_id" => $data['idInterview'],
                "date_start"         => date("Y-m-d", strtotime($data['dateStart'])),
                "date_end"           => date("Y-m-d", strtotime($data['dateEnd'])),
                "time_start"         => $data['timeStart'],
                "time_end"           => $data['timeEnd']
            ]);
            
            if ($insertReschedule) {
                $count = $data['countInterview']+1;
                $updateInterview = InterviewEvent::where('id', $data['idInterview'])->update([
                    "status" => 4,
                    "reshedule_count" => $count
                ]);
                $id = base64_encode(urlencode($data["idJob"]));
                $messages = [
                    'status' => 'success',
                    'message' => 'Reschedule Interview Success',
                    'url' => '/profile/my-app-detail/'.$id,
                    'callback' => 'redirect'
                ];

                return response()->json($messages);
            } else {
                $messages = [
                    'status' => 'error',
                    'message' => 'Reschedule Interview Failed',
                ];
    
                return response()->json($messages);
            }
            
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Cannot Reschedule more than 3 times',
            ];

            return response()->json($messages);
        }
    }
    
}
