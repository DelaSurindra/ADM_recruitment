<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Model\Candidate;
use App\Model\User;
use App\Model\Education;
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
                    'gender' => $collection[$i][4],
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
                    "gelar" => $collection[$i][8],
                    "fakultas" => $collection[$i][9],
                    "jurusan" => $collection[$i][10],
                    "start_year" => $collection[$i][11],
                    "end_year" => $collection[$i][12],
                    "gpa" => $collection[$i][13],
                    "kandidat_id" => $candidate,
        
                ]);
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
