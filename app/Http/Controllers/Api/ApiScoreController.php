<?php

namespace App\Http\Controllers\Api;

use App\tb_pertandingan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiScoreController extends Controller
{
    public function score(){
        $score = tb_pertandingan::all();
        return $score;
    }


}
