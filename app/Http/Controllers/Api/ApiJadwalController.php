<?php

namespace App\Http\Controllers\Api;

use App\tb_jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiJadwalController extends Controller
{
    public function jadwal(){
        $jadwal = tb_jadwal::with('kelas', 'kelas1', 'cb_olahraga')->get();
        return $jadwal;
    }
}
