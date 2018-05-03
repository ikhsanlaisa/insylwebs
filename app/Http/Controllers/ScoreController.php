<?php

namespace App\Http\Controllers;

use App\tb_jadwal;
use App\tb_kelas;
use App\tb_pertandingan;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $score = tb_pertandingan::all();
        return view("admin.data_score")->with('score', $score);
    }

    public function create(){
        $jadwal = tb_jadwal::all();
        $kelas = tb_kelas::all();
        return view("admin.tambah_score")->with(['jadwal'=> $jadwal, 'kelas'=>$kelas]);
    }

    public function show($id){
        $jad = tb_jadwal::find($id);
        $tim1 = $jad->kelas()->first();
        $tim2 = $jad->kelas1()->first();
        $cabor = $jad->cb_olahraga()->first();
        $returnJSON = [
            "jadwal"=>$jad,
            "tim1"=>$tim1,
            "tim2"=>$tim2,
            "cabor"=>$cabor
        ];

        return json_encode($returnJSON);
    }

    public function store(Request $request){
        $score = new tb_pertandingan();
        $score->jadwal_id = $request->input('jadwal');
        $score->cabor = $request->input('caborid');
        $score->tim1 = $request->input('tim1id');
        $score->tim2 = $request->input('tim2id');
        $score->keterangan = $request->input('keterangan');
        $score->lokasi = $request->input('lokasis');
        $score->score = $request->input('score');
        $result = $score->save();
        if ($result){
            return redirect('/tambah_score')->with(['message' => 'Berhasil Tambah Score']);
        }else{
            return redirect('/tambah_score')->with(['message' => 'Gagal Tambah Score']);
        }


    }

    public function shows($id){
        $scr = tb_pertandingan::find($id);
        $jad = $scr->jadwal()->first();
        $data = [
            "scr" => $scr,
            "jad" => $jad
        ];
        return json_encode($data);
    }

    public function update(Request $request, $id){
        $sc = tb_pertandingan::find($id);
        $sc->score = $request->input('score');
        $sc->keterangan = $request->input('keterangan');
        $result = $sc->save();
        if ($result){
            return redirect('/datascore')->with(['message' => 'Berhasil update Score']);
        }else{
            return redirect('/datascore')->with(['message' => 'Gagal update Score']);
        }
    }

    public function destroy($id){
        $score = tb_pertandingan::find($id);
        $result = $score->delete();
        if ($result){
            return redirect('/datascore')->with(['message' => 'Berhasil Hapus Score']);
        }
        return redirect('/datascore')->with(['message' => 'Gagal Hapus Score']);
    }
}
