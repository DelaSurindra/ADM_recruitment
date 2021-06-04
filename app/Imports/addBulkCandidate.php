<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Model\Candidate;
use App\Model\User;
use App\Model\Education;
use App\Jobs\JobSendEmail;
use Maatwebsite\Excel\Concerns\ToModel;

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

    public function collection(Collection $collection)
    {
        if (count($collection) == 0) {
            $messages = [
                'status' => 'error',
                'message' => 'Please inser data',
                'url' => 'close',
                'id' => '',
                'value' => ''
            ];

            return back()->with('notif', $messages);
        }else{
            for ($i=1; $i < count($collection); $i++) {
                if ($collection[$i][4] == "male" || $collection[$i][4] == "Male" || $collection[$i][4] == "MALE") {
                    $gender = "1";
                } else {
                    $gender = "2";
                }

                if($collection[$i][8] == "d3" || $collection[$i][8] == "D3"){
                    $gelar = "1";
                }elseif ($collection[$i][8] == "s1" || $collection[$i][8] == "S1") {
                    $gelar = "2";
                }else{
                    $gelar = "3";
                }
                
                $password = $this->generateRandomString(8);
                $insertUser = User::insertGetId([
                    'email' => $collection[$i][2],
                    'type' => '1',
                    'password' => bcrypt($password.env('SALT_PASS_CANDIDATE'))
                ]);
                
                $candidate = Candidate::insertGetId([
                    'first_name' => $collection[$i][0],
                    'last_name' => $collection[$i][1],
                    'tanggal_lahir' => date('Y-m-d', strtotime($collection[$i][3])),
                    'gender' => $gender,
                    'telp' => $collection[$i][5],
                    'kota' => $collection[$i][6],
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
                    "universitas" => $collection[$i][7],
                    "gelar" => $gelar,
                    "fakultas" => $collection[$i][9],
                    "jurusan" => $collection[$i][10],
                    "start_year" => $collection[$i][11],
                    "end_year" => $collection[$i][12],
                    "gpa" => $collection[$i][13],
                    "kandidat_id" => $candidate,
        
                ]);

                $dataEmail = [
                    'email'         => $collection[$i][2],
                    'nama'          => $collection[$i][0].' '.$collection[$i][1],
                    'password'      => $password,
                    'subject'       => 'Register Invitation',
                    'view'          => 'email.email-invit-candidate'
                ];
        
                $response = JobSendEmail::dispatch($dataEmail);
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
}
