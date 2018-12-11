<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    //
    protected $table = 'pelamar';
    protected $primaryKey = 'id';
    protected $fillable = ['firstname','lastname','tanggal_lahir','tempat_lahir','alamat','no_hp','email','kampus','jurusan','file_cv'];
}
