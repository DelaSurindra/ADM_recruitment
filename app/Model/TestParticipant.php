<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TestParticipant extends Model
{
    //
    protected $table = "test_participant";

    protected $fillable = ["location_start","location_start_radius","location_end","location_end_radius"];
}
