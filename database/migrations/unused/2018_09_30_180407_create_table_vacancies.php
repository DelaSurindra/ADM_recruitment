<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVacancies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vacancies', function (Blueprint $table) {
            $table->string('job_id');
            $table->primary('job_id');
            $table->string('job_title');
            $table->text('job_poster');
            $table->text('job_description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->index('job_title');
            //
        });

        // $positions = [
        //     "android"=>["src"=>"recruitment/android.png","title"=>"Android Developer"],
        //     "web"=>["src"=>"recruitment/web.png","title"=>"Web Developer"],
        //     "bisdev"=>["src"=>"recruitment/bisdev.png","title"=>"Manger Business Development"],
        //     "bisnis"=>["src"=>"recruitment/bisnis.png","title"=>"Junior Business Analyst"],
        //     "core"=>["src"=>"recruitment/core.png","title"=>"Core Developer"],
        //     "core"=>["src"=>"recruitment/dba.png","title"=>"Database Administrator"],
        //     "core"=>["src"=>"recruitment/devop.png","title"=>"Development Operation"],
        //     "legal"=>["src"=>"recruitment/legal.png","title"=>"Legal Officer"],
        //     "opr"=>["src"=>"recruitment/opr.png","title"=>"Operation & Maintenance Officer"],
        //     "prodser"=>["src"=>"recruitment/prodser.png","title"=>"Supervisor Product & Services Management"],
        //     "recon"=>["src"=>"recruitment/recon.png","title"=>"Reconcilitaion Officer"],
        //     "recrut"=>["src"=>"recruitment/recrut.png","title"=>"Recruitment Officer"],
        //     "system"=>["src"=>"recruitment/system.png","title"=>"System Administrator"],
        //     "testing"=>["src"=>"recruitment/testing.png","title"=>"Application Tester"],
        // ];

        // echo "Populating default vacancies. Please wait. \n";

        // foreach ($positions as $key => $_pos) {
        //     # code...
        //      DB::table('vacancies')->insert([
        //             'job_id' => $key,
        //             'job_title' => $_pos['title'],
        //             'job_poster' => $_pos['src']
        //         ]);
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('vacancies');
    }
}
