<?php

namespace App\Http\Controllers\Api;

use App\tb_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiKelasController extends Controller
{
    public function kelas(){
        $kelas = tb_kelas::all();
        return response()->json($kelas);
    }
}
