<?php

namespace App\Http\Controllers\Api;

use App\news;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiNewsController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware("jwt.auth");
//    }

    public function news(){
        $news = news::all();
        return response()->json($news);
    }

    public function show(){
        $news = news::where('id')->get();
        return response()->json($news);
    }
}
