<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Security\EncryptController;
use App\Http\Controllers\Security\ValidatorController;
use App\Http\Controllers\RequestController;
use App\Model\Vacancy;
use App\Model\Wilayah;
use App\Model\Candidate;
use App\Model\User;
use App\Model\Job_application;
use App\Model\Education;
use App\Model\MasterUniversitas;
use App\Model\MasterMajor;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\addBulkCandidate;
use App\Exports\DownloadDefault;
use Hash;
use Request;
use Session;
use DB;
use Response;

class CandidateController extends Controller
{
    public function viewCandidate(){
        $vacancy = Vacancy::select('job_id', 'job_title')->get()->toArray();
        return view('admin.candidate.candidate-list')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'vacancy'=>$vacancy]);
    }

    public function listCandidate(){

        $dataSend = array(
            "search"     => Request::input('search')['value'],
            "offset"     => Request::input('start'),
            "limit"      => Request::input('length'),
            'order'      => (!empty(Request::get('columns')[Request::get('order')[0]['column']]['data'])) ? Request::get('columns')[Request::get('order')[0]['column']]['data'] : '',
            'sort'       => (!empty(Request::get('order')[0]['dir'])) ? Request::get('order')[0]['dir'] : '',

        );

        $candidate = Candidate::select('kandidat.*', 'users.email')
                                ->join('users', 'kandidat.user_id', 'users.id');

        if ($dataSend['search']){
            $candidate = $candidate->where('kandidat.first_name','like','%'.$dataSend['search'].'%')->orWhere('kandidat.last_name','like','%'.$dataSend['search'].'%');
        }
        $countCandidate = $candidate->count();

        $listCandidate = $candidate->skip(intval( $dataSend["offset"]))->take(intval($dataSend["limit"]));
        if ($dataSend["order"]) {
            if ($dataSend["order"] == "created_at") {
                $dataSend["order"] = 'kandidat.created_at';
            }
            $listCandidate = $listCandidate->orderBy($dataSend["order"], $dataSend["sort"])->get()->toArray();
        } else {
            $listCandidate = $listCandidate->orderBy('kandidat.created_at', $dataSend["sort"])->get()->toArray();
        }

        for ($i=0; $i < count($listCandidate); $i++) { 
            $listCandidate[$i]['created_at'] = date('d/m/Y', strtotime($listCandidate[$i]['created_at']));
            $listCandidate[$i]['tanggal_lahir'] = date('d/m/Y', strtotime($listCandidate[$i]['tanggal_lahir']));
        }
        
        if ($listCandidate != null) {
            $response = array(
                "draw"              => Request::get('draw'),
                "recordsTotal"      => $countCandidate,
                "recordsFiltered"   => $countCandidate,
                "data"              => $listCandidate
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

    public function viewCandidateAdd(){
        $universitas = MasterUniversitas::get()->toArray();
        $major = MasterMajor::get()->toArray();
        $wilayah = Wilayah::select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->get()->toArray();
        $breadcrumb = [
            "page"      => "Manage Candidate",
            "detail"    => "Add Candidate",
            "route"     => "/HR/candidate"
        ];
        return view('admin.candidate.candidate-add')->with(['pageTitle' => 'Manajemen Candidate', 'title' => 'Manajemen Candidate', 'sidebar' => 'manajemen_candidate', 'breadcrumb' => $breadcrumb, 'universitas' => $universitas, 'major' => $major, 'wilayah' => $wilayah]);
    }

    public function viewCandidateEdit($id){
        $idCandidate = base64_decode(urldecode($id));
        // dd($idCandidate);
        $listCandidate = Candidate::select('kandidat.*', 'users.email')
                                    ->join('users', 'kandidat.user_id', 'users.id')
                                    ->where('kandidat.id', $idCandidate)->get()->toArray();
        if ($listCandidate) {
            $listCandidate[0]['pendidikan'] = [];
            $listCandidate[0]['submit_date'] = date('m/d/Y', strtotime($listCandidate[0]['created_at']));

            $date = date('m/d/Y', strtotime($listCandidate[0]['tanggal_lahir']));
            $birthDate = explode("/", $date);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));

            $listCandidate[0]['age'] = $age;
            $listCandidate[0]['tanggal_lahir'] = date('d/m/Y', strtotime($listCandidate[0]['tanggal_lahir']));

            $kandidat_id = [];
            array_push($kandidat_id, $listCandidate[0]['id']);

            $pendidikan_kandidat_id = [];
            $education = Education::get()->toArray();
            
            for ($i=0; $i < count($education); $i++) { 
                array_push($pendidikan_kandidat_id, $education[$i]['kandidat_id']);
            }

            
            $dummy = [];
            for ($i=0; $i < count($pendidikan_kandidat_id); $i++) { 
                $search = array_search($pendidikan_kandidat_id[$i], $kandidat_id);
                array_push($dummy, $search.','.$i);
            }
            foreach ($dummy as $key => $value) {
                $exp = explode(",", $value);
                if ($exp[0] != "") {
                    array_push($listCandidate[$exp[0]]['pendidikan'], $education[$exp[1]]);
                }
    
            }
            $universitas = MasterUniversitas::get()->toArray();
            $major = MasterMajor::get()->toArray();
            // dd($listCandidate);
            $breadcrumb = [
                "page"      => "Manage Candidate",
                "detail"    => "Edit Candidate",
                "route"     => "/HR/candidate"
            ];
            return view('admin.candidate.candidate-edit')->with([
                'pageTitle' => 'Manajemen Candidate', 
                'title' => 'Manajemen Candidate', 
                'sidebar' => 'manajemen_candidate', 
                'breadcrumb' => $breadcrumb, 
                'data'=>$listCandidate[0],
                'universitas' => $universitas, 
                'major' => $major
            ]);
        }else{
            abort(404);
        }
    }

    public function editCandidate(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        
        if (is_array($data['idPendidikan']) && count($data['idPendidikan']) > 1) {
            for ($i=0; $i < count($data['idPendidikan']); $i++) { 
                $updatePendidikan = Education::where('id', $data['idPendidikan'][$i])->update([
                    'universitas' => $data['universitas'][$i],
                    'fakultas' => $data['faculty'][$i],
                    'jurusan' => $data['jurusan'][$i],
                    'start_year' => $data['start_year'][$i],
                    'end_year' => $data['end_year'][$i]
                ]);
            }
        }else{
            $updatePendidikan = Education::where('id', $data['idPendidikan'])->update([
                'universitas' => $data['universitas'],
                'fakultas' => $data['faculty'],
                'jurusan' => $data['jurusan'],
                'start_year' => $data['start_year'],
                'end_year' => $data['end_year']
            ]);
        }

        if ($updatePendidikan) {
            return [
                'status'   => 'success',
                'message'  => 'Berhasil Mengubah Data Kandidat',
                'url'      => '/HR/candidate',
                'callback' => 'redirect'
            ];
        }else{
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Data Kandidat',
            ];
        }
    }

    public function downloadFile(){
        return Excel::download(new DownloadDefault(), 'Default-add-bulk-candidate.xlsx');
    }

    public function bulkUpdate(){
        $encrypt = new EncryptController;
        $data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data);
        for ($i=0; $i < count($data['idJob']); $i++) { 
            $exp = explode("_", $data['idJob'][$i]);
            // dd($exp);
            $update = Job_application::where('id', $exp[0])->update(['status'=>$data['aplicationStatus']]);
            $track = $this->statusTrackApply($exp[0], $data['aplicationStatus']);
        }

        if ($update) {
            return [
                'status'   => 'success',
                'message'  => 'Berhasil Mengubah Data Bulk Kandidat',
                'url'      => '/HR/candidate',
                'callback' => 'redirect'
            ];
        } else {
            return [
                'status'   => 'error',
                'message'  => 'Gagal Mengubah Data Bulk Kandidat',
            ];
        }
        
    }

    public function addCandidate(){
        $encrypt = new EncryptController;
    	$data = $encrypt->fnDecrypt(Request::input('data'),true);
        // dd($data, $password);

        $searchEmail = User::where('email', $data['email'])->first();
        if ($searchEmail) {
            $messages = [
                'status' => 'error',
                'message' => 'Email has registered',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        } else {
            $password = $this->generateRandomString(8);
            $insertUser = User::insertGetId([
                'email' => $data['email'],
                'type' => '1',
                'password' => bcrypt($password.env('SALT_PASS_CANDIDATE'))
            ]);

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
                $path_cover_letter = "";
            }
            // Resume
            if (Request::has('resume')) {
                $image = Request::file('resume');
                $ext = $image->getClientOriginalExtension();    
                $path_resume = $image->storeAs('resume', 'resume_'.time().'.'.$ext, 'public');
            } else {
                $path_resume = "";
            }
            // Portofolio
            if (Request::has('portofolio')) {
                $image = Request::file('portofolio');
                $ext = $image->getClientOriginalExtension();    
                $path_portofolio = $image->storeAs('portofolio', 'portofolio_'.time().'.'.$ext, 'public');
            } else {
                $path_portofolio = "";
            }

            $candidate = Candidate::insertGetId([
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
                'user_id' => $insertUser,
                'status' => 0
            ]);

            if ($candidate) {
                
                if (is_array($data['university'])) {
                    for ($i=0; $i < count($data['university']); $i++) {
                        if (Request::has('certificate')) {
                            $image = Request::file('certificate');
                            $ext = $image[$i]->getClientOriginalExtension();
                            $path_certificate = $image[$i]->storeAs('certificate', 'certificate_'.time().'.'.$ext, 'public');
                        }else{
                            $path_certificate = '';
                        }
        
                        $education = new Education;
                        $education->universitas = $data['university'][$i];
                        $education->gelar = $data['degree'][$i];
                        $education->fakultas = $data['faculty'][$i];
                        $education->jurusan = $data['major'][$i];
                        $education->start_year = $data['startDateEducation'][$i];
                        $education->end_year = $data['endDateEducation'][$i];
                        $education->ijazah = $path_certificate;
                        $education->gpa = $data['gpa'][$i];
                        $education->kandidat_id = $candidate;
                        $education->save();
                    }
                } else {
                    if (Request::has('certificate')) {
                        $image = Request::file('certificate');
                        $ext = $image[0]->getClientOriginalExtension();
                        $path_certificate = $image[0]->storeAs('certificate', 'certificate_'.time().'.'.$ext, 'public');
                    }else{
                        $path_certificate = '';
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
                    $education->kandidat_id = $candidate;
                    $education->save();
                }

                $messages = [
                    'status' => 'success',
                    'message' => 'Create Candidate Success',
                    'url' => 'close',
                    'id' => '',
                    'value' => ''
                ];

                return redirect('/HR/candidate')->with('notif', $messages);
            } else {
                $messages = [
                    'status' => 'error',
                    'message' => 'Create Candidate Failed',
                    'url' => 'close',
                    'id' => '',
                    'value' => ''
                ];

                return back()->with('notif', $messages);
            }
        }
    }

    public function addBulk(){
        if (Request::has('fileBulk')) {
            $file = Request::file('fileBulk');
            $nama_file = rand().$file->getClientOriginalName();
            $file->move(public_path('storage').'/'.'candidate',$nama_file);
            Excel::import(new addBulkCandidate, public_path('storage').'/'.'candidate/'.$nama_file);
            
            $messages = [
                'status' => 'success',
                'message' => 'Create Bulk Candidate Success',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return redirect('/HR/candidate')->with('notif', $messages);
        }else{
            $messages = [
                'status' => 'error',
                'message' => 'Pleasce choose file',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        }
    }

    public function getMaster(){
        $universitas = MasterUniversitas::get()->toArray();
        $major = MasterMajor::get()->toArray();

        $data = [
            'universitas' => $universitas,
            'major'       => $major
        ];

        return response()->json($data);
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
