<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelamar extends Model
{
	use SoftDeletes;
    //
    protected $table = 'pelamar';
    protected $primaryKey = 'id';
    protected $fillable = ['firstname','lastname','tanggal_lahir','tempat_lahir','alamat','no_hp','email','kampus','jurusan','info','file_cv'];
}
