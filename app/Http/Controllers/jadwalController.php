<?php

namespace App\Http\Controllers;

use App\cb_olahraga;
use App\tb_jadwal;
use App\tb_kelas;
use Illuminate\Http\Request;

class jadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = tb_jadwal::all();
        $kelas = tb_kelas::all();
        $lomba = cb_olahraga::all();
        return view('admin.jadwal')->with(['jadwal' => $jadwal, 'kelas' => $kelas, 'lomba' => $lomba]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = tb_kelas::all();
        $lomba = cb_olahraga::all();
        return view('admin.tambah_jadwal')->with(['kelas' => $kelas, 'lomba' => $lomba]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jadwal = new tb_jadwal();
        $jadwal->tim1 = $request->input('tim1');
        $jadwal->tim2 = $request->input('tim2');
        $jadwal->lokasi = $request->input('lokasi');
        $jadwal->date_time = $request->input('tgl');
        $jadwal->olahraga_id = $request->input('olahraga_id');
        $result = $jadwal->save();
        if ($result) {
            return redirect('/tambah_jadwal')->with(['message' => 'Berhasil Tambah Jadwal']);
        } else {
            return redirect('/tambah_jadwal')->with(['message' => 'Gagal Tambah Jadwal']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jad = tb_jadwal::where('id',$id)->get();
        return json_encode($jad);

//        $kelas = tb_kelas::where('id', $id)->get();
//        return json_encode($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwal = tb_jadwal::find($id);
        if ($request->input('tim1')) {
            $jadwal->tim1 = $request->input('tim1');
        }
        if ($request->input('tim2')) {
            $jadwal->tim2 = $request->input('tim2');
        }
        if ($request->input('lokasi')) {
            $jadwal->lokasi = $request->input('lokasi');
        }
        if ($request->input('tgl')) {
            $jadwal->date_time = $request->input('tgl');
        }
        if ($request->input('olahraga_id')) {
            $jadwal->olahraga_id = $request->input('olahraga_id');
        }
        $result = $jadwal->save();
        if ($result) {
            return redirect('/jadwal')->with(['message' => 'Berhasil Update Jadwal']);
        } else {
            return redirect('/jadwal')->with(['message' => 'Gagal Update Jadwal']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = tb_jadwal::find($id);
        $result = $jadwal->delete();
        if ($result){
            return redirect('/jadwal')->with(['message' => 'Berhasil Hapus Jadwal']);
        }
        return redirect('/jadwal')->with(['message' => 'Gagal Hapus Jadwal']);
    }
}
