<?php

namespace App\Http\Controllers\Api;

use App\cb_olahraga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCaborController extends Controller
{
    public function cabor(){
        $cabor = cb_olahraga::all();
        return response()->json($cabor);
    }
}
