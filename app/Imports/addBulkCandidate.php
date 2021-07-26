<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Model\Candidate;
use App\Model\User;
use App\Model\Education;
use App\Jobs\JobSendEmail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class addBulkCandidate implements ToCollection
{
    /**
    * @param Collection $collection
    */
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $messages = array(
		"required" => "Mohon isi kolom ini.",
        "regex" => "Format tidak sesuai"
	);

    private $label = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'
    );

    public function __construct()
    {
        $this->data = [];
    }

    public function collection(Collection $collection)
    {
        // dd(count($collection));
        if (count($collection) == 1) {
            // $this->dataBulk($this->data);
        }else{
            $rows = $collection->toArray();
            $header = $rows[0];
            unset($rows[0]);
            $rows = array_values($rows);
            // dd($rows);
            try {
                Validator::make($rows, [
                    '*.0' => ["required", "regex:/^[a-zA-Z.' ]*$/"], // first name
                    '*.1' => ["required", "regex:/^[a-zA-Z.' ]*$/"], // last name
                    '*.2' => ["required"], // email
                    '*.3' => ["required"], // birth date
                    '*.4' => ["required"], // gender
                    '*.5' => ["required", "regex:/^\d{11,13}$/"], // phone
                    '*.6' => ["required"], // location
                    '*.7' => ["required", "regex:/^[a-zA-Z0-9 ]*$/"], // univ
                    '*.8' => ["required"], // degree
                    '*.9' => ["required", "regex:/^[a-zA-Z0-9 ]*$/"], // faculty
                    '*.10' => ["required"], // major
                    '*.11' => ["required"], // start year
                    '*.12' => ["required"], // end year
                    '*.13' => ["required"], // gpa
                ], $this->messages)->validate();
                
                for ($i=0; $i < count($rows); $i++) { 
                    $checkUser = User::where('email', $rows[$i][2])->get()->toArray();
                    if ($checkUser) {
                        $dataRes = [
                            'email' => $rows[$i][2],
                            'status' => 'Failed',
                            'note' => 'Email already exist'
                        ];
                        array_push($this->data, $dataRes);
                    } else {
                        $password = $this->generateRandomString(8);
                        $insertUser = User::insertGetId([
                            'email' => $rows[$i][2],
                            'type' => '1',
                            'password' => bcrypt($password.env('SALT_PASS_CANDIDATE'))
                        ]);
                        
                        if ($rows[$i][4] == "male" || $rows[$i][4] == "Male" || $rows[$i][4] == "MALE") {
                            $gender = "1";
                        } else {
                            $gender = "2";
                        }
    
                        if($rows[$i][8] == "d3" || $rows[$i][8] == "D3"){
                            $gelar = "1";
                        }elseif ($rows[$i][8] == "s1" || $rows[$i][8] == "S1") {
                            $gelar = "2";
                        }else{
                            $gelar = "3";
                        }

                        $candidate = Candidate::insertGetId([
                            'first_name' => $rows[$i][0],
                            'last_name' => $rows[$i][1],
                            'tanggal_lahir' => date('Y-m-d', strtotime($rows[$i][3])),
                            'gender' => $gender,
                            'telp' => $rows[$i][5],
                            'kota' => $rows[$i][6],
                            'linkedin' => "",
                            'cover_letter' => "",
                            'resume' => "",
                            'protofolio' => "",
                            'foto_profil' => "",
                            'skill' => "",
                            'user_id' => $insertUser,
                            'status' => 0
                        ]);
                        $education = Education::insert([
                            "universitas" => $rows[$i][7],
                            "gelar" => $gelar,
                            "fakultas" => $rows[$i][9],
                            "jurusan" => $rows[$i][10],
                            "start_year" => $rows[$i][11],
                            "end_year" => $rows[$i][12],
                            "gpa" => str_replace(',', '.', round($rows[$i][13], 2)),
                            "kandidat_id" => $candidate,
                        ]);
                        $dataRes = [
                            'email' => $rows[$i][2],
                            'status' => 'Success',
                            'note' => ''
                        ];
                        array_push($this->data, $dataRes);
                        $dataEmail = [
                            'email'         => $rows[$i][2],
                            'nama'          => $rows[$i][0].' '.$rows[$i][1],
                            'password'      => $password,
                            'subject'       => 'Register Invitation',
                            'view'          => 'email.email-invit-candidate'
                        ];
                        
                        $response = JobSendEmail::dispatch($dataEmail);
                    }
                }
            } catch (\Throwable $th) {
                // dd($th);
                $error = $th->validator->failed();
                $message = $th->validator->messages()->messages();
                $data = $th->validator->getData();
                // dd($error, $message, $data);
                $key = array_key_first($error);
                $pecah = explode('.', $key);
                $val = array_values($message)[0];
                
                $dataRes = [
                    'email' => $data[$pecah[0]][$pecah[1]],
                    'status' => 'Failed',
                    'note' => 'Line '.$this->label[$pecah[1]].($pecah[0]+2).' : '.$val[0]
                ];
                // dd($dataRes);
                array_push($this->data, $dataRes);
            }
        }
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

    function getResponse(){
        return $this->data;
    }
}
