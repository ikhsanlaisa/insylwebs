<?php

namespace App\Http\Controllers;

use App\tb_kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class kelasController extends Controller
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
        $kelas = tb_kelas::all();
        return view('admin.datakelas')->with('kelas', $kelas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah_kelas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filepath = 'images/kelas/';

        $clas = Input::get('kelas');
        $cek = tb_kelas::where('nama_kelas', '=', $clas)->exists();
        if ($cek) {
            return redirect('/tambah_kelas')->with(['message' => 'Kelas Sudah Ada']);
        } else {
            $klas = new tb_kelas();
            $klas->nama_kelas = $request->input('kelas');
            if ($request->file('foto')) {
                $class = $request->file('foto');
                $klass = $class->getClientOriginalName();
                $class->move($filepath, $klass);
                $klas->foto = $klass;
            }
        }

        $result = $klas->save();
        if ($result) {
            return redirect('/tambah_kelas')->with(['message' => 'Berhasil Tambah Kelas']);
        }
        return redirect('/tambah_kelas')->with(['message' => 'Gagal Tambah Kelas']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $kelas = tb_kelas::find($id);
        return json_encode($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        $kelas = tb_kelas::find($id);
        $filepath = 'images/kelas';
        if ($request->file('foto')) {
            $foto = $request->file('foto');

            $fotos = $foto->getClientOriginalName();
            $foto->move($filepath, $fotos);

            $kelas->foto = $fotos;
        }
        if ($request->input('kelas')){
        $kelas->nama_kelas = $request->input('kelas');
        }
        $result = $kelas->save();

        if ($result) {
            return redirect('/datakelas')->with(['message' => 'Berhasil Update Kelas']);
        }
        return redirect('/datakelas')->with(['message' => 'Gagal Update Kelas']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $kelas = tb_kelas::find($id);
        $result = $kelas->delete();
        if ($result) {
            return redirect('/datakelas')->with(['message' => 'Berhasil Hapus Kelas']);
        }
        return redirect('/datakelas')->with(['message' => 'Gagal Hapus Kelas']);
    }
}
