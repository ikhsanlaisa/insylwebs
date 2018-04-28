<?php

namespace App\Http\Controllers;

use App\cb_olahraga;
use Illuminate\Http\Request;

class lombaController extends Controller
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
        $lomba = cb_olahraga::all();
        return view('admin.data_lomba')->with('lomba', $lomba);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah_lomba');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lomba = new cb_olahraga();
        $lomba->cabang_olahraga = $request->input('lomba');
        $lomba->pj = $request->input('pj');
        $result = $lomba->save();
        if ($result){
            return redirect('/tambah_lomba')->with(['message' => 'Berhasil Tambah Lomba']);
        }else{
            return redirect('/tambah_lomba')->with(['message' => 'Gagal Tambah Lomba']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lomba = cb_olahraga::where('id', $id)->get();
        return json_encode($lomba);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lomba = cb_olahraga::find($id);
        $lomba->cabang_olahraga = $request->input('lomba');
        $lomba->pj = $request->input('pj');
        $result = $lomba->save();
        if ($result){
            return redirect('/data_lomba')->with(['message' => 'Berhasil Update Lomba']);
        }else{
            return redirect('/data_lomba')->with(['message' => 'Gagal Update Lomba']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lomba = cb_olahraga::find($id)->first();
        $result = $lomba->delete();
        if ($result){
            return redirect('/data_lomba')->with(['message' => 'Berhasil Hapus Lomba']);
        }else{
            return redirect('/data_lomba')->with(['message' => 'Gagal Hapus Lomba']);
        }
    }
}
