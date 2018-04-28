<?php

namespace App\Http\Controllers;

use App\tb_kontak;
use Illuminate\Http\Request;

class kontakController extends Controller
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
        $kontak = tb_kontak::all();
        return view('admin.kontak')->with('kontak', $kontak);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah_kontak');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filepath = 'images/kontak/';

        $foto = $request->file('foto');
        $fotos = $foto->getClientOriginalName();
        $foto->move($filepath, $fotos);

        $kontak = new tb_kontak();
        $kontak->nama = $request->input('nama');
        $kontak->email = $request->input('email');
        $kontak->no_telp = $request->input('telp');
        $kontak->foto = $fotos;
        $result = $kontak->save();
        if ($result) {
            return redirect('/tambah_kontak')->with(['message' => 'Berhasil Tambah Kontak']);
        }
        return redirect('/tambah_kontak')->with(['message' => 'Gagal Tambah Kontak']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontak = tb_kontak::where('id', $id)->get();
        return json_encode($kontak);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $kontak = tb_kontak::find($id);
        $filepath = 'images/kontak/';

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotos = $foto->getClientOriginalName();
            $foto->move($filepath, $fotos);

            $kontak->foto = $fotos;
        }
        $kontak->nama = $request->input('nama');
        $kontak->email = $request->input('email');
        $kontak->no_telp = $request->input('telp');

        $result = $kontak->save();
        if ($result) {
            return redirect('/datakontak')->with(['message' => 'Berhasil Tambah Kontak']);
        }
        return redirect('/datakontak')->with(['message' => 'Gagal Tambah Kontak']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kontak = tb_kontak::find($id);
        $result = $kontak->delete();
        if ($result){
            return redirect('/datakontak')->with(['message' => 'Berhasil Hapus Kontak']);
        }
        return redirect('/datakontak')->with(['message' => 'Gagal Hapus Kontak']);
    }
}
