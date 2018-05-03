<?php

namespace App\Http\Controllers\Api;

use App\tb_pertandingan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiScoreController extends Controller
{
    public function score(){
        $score = tb_pertandingan::with('tim1', 'tim2', 'cabor')->get();
        return $score;
    }


}
