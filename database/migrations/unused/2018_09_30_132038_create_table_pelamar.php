<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePelamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pelamar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('kampus');
            $table->string('jurusan');
            $table->text('file_cv')->nullable();
            $table->timestamps();
            $table->index('job_id');
            $table->index('firstname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('pelamar');
    }
}
