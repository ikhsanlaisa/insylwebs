<?php

namespace App\Http\Controllers\Api;

use App\tb_kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiKontakController extends Controller
{
    public function kontak(){
        $kontak = tb_kontak::all();
        return $kontak;
    }
}
