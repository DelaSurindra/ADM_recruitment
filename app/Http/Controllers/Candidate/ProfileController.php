<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Candidate;
use App\Model\Education;
use App\Model\Wilayah;
use App\Model\User;

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
            
            return view('candidate.profile.first-login-candidate')->with(['topbar'=>'first_login', 'wilayah'=>$wilayah]);
        }
    }

    public function postFirstLogin(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, Request::file('certificate'));
        // Belum ada Kolom di DB
        // photo profile
        // gpa (education)
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
                $education->kandidat_id = $data['idCandidate'];
                $education->save();
            }
        }

        if ($candidate) {
            Session::forget('session_candidate');
            $user = User::select('kandidat.*', 'users.email', 'users.password', 'users.type', 'users.status')
                ->join('kandidat', 'users.id', 'kandidat.user_id')
                ->where('users.id', $cekEmail->id)->first()->toArray();
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

            return back()->with('notif', $messages);
        }
    }

    public function viewProfile(){
        return view('candidate.profile.profile-child')->with(['topbar'=>'profile']);
    }

    public function editPersonalInformation(){
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();

        return view('candidate.profile.personal-information')->with(['topbar'=>'personal_information', 'wilayah'=>$wilayah]);
    }

    public function postEditPersonalInformation(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        dd($data);
        // Photo Profile
        if (Request::has('photoProfile')) {
            $image = Request::file('photoProfile');
            $ext = $image->getClientOriginalExtension();    
            $path_photo_profile = $image->storeAs('photo-profile', 'photo_profile_'.time().'.'.$ext, 'public');
            // $sql->image_logo = $path; di db nggk ada kolomnya
        }

        $candidate = Candidate::where('id', $data['idCandidate'])->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'tanggal_lahir' => $data['birthDate'],
            'gender' => isset($data['gender']) ? $data['gender'] : null,
            'telp' => $data['phoneNumber'],
            'kota' => $data['myLocation'],
            'linkedin' => $data['lingkedInLink'],
        ]);

        if ($candidate) {
            $messages = [
                'status' => 'success',
                'message' => 'Success Edit Personal Information',
                'url' => 'close'
            ];

            return redirect('/')->with('notif', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Failed Edit Personal Information',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function editOtherInformation(){
        return view('candidate.profile.other-information')->with(['topbar'=>'other_information']);
    }

    public function postEditOtherInformation(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        dd($data);

        $candidate = Candidate::where('id', $data['idCandidate'])->update([
            'cover_letter' => $path_cover_letter,
            'resume' => $path_resume,
            'protofolio' => $path_portofolio,
            'skill' => $data['skill'],
        ]);

        if ($candidate) {
            $messages = [
                'status' => 'success',
                'message' => 'Success Edit Other Information',
                'url' => 'close'
            ];

            return redirect('/')->with('notif', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Failed Edit Other Information',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function editEducationInformation(){
        return view('candidate.profile.education-information')->with(['topbar'=>'education_information']);
    }

    public function postEditEducationInformation(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, Request::file('certificate'), $data['startDateEducation']);

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
                $education->kandidat_id = $data['idCandidate'];
                $education->save();
            }
        }

        if ($education->save()) {
            $messages = [
                'status' => 'success',
                'message' => 'Success Edit Education Information',
                'url' => 'close'
            ];

            return redirect('/')->with('notif', $messages);
        } else {
            $messages = [
                'status' => 'error',
                'message' => 'Failed Edit Education Information',
                'url' => 'close'
            ];

            return back()->with('notif', $messages);
        }
    }

    public function postEditPassword(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, Session::get('session_candidate'));
        $pass = User::where('id', Session::get('session_candidate')['user_id'])->where('type', '1')->first();

        if (Hash::check($data['oldPassword'].env('SALT_PASS_CANDIDATE'), $pass->password)) {
            $update = User::where('id', Session::get('session_candidate')['user_id'])->update([
                'password' => bcrypt($data['newPasswordConfirm'].env('SALT_PASS_CANDIDATE'))
            ]);
    
            if ($update) {
                return [
                    'status'   => 'success',
                    'message'  => 'Change Password Success, Please Login Again',
                    'url'      => '/signout',
                    'callback' => 'redirect'
                ];
            }else{
                return [
                    'status'   => 'error',
                    'message'  => 'Change Password Failed',
                ];
            }
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Old Password does not Match',
            ];
        }
    }

    public function myAppDetail(){
        return view('candidate.profile.my-app-detail')->with(['topbar'=>'myapp_detail']);
    }

    public function testReschedule(){
        return view('candidate.profile.test-reschedule')->with(['topbar'=>'test_reschedule']);
    }

    public function interviewReschedule(){
        return view('candidate.profile.interview-reschedule')->with(['topbar'=>'interview_reschedule']);
    }
}
