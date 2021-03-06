<?php

namespace App\Http\Controllers\Api;

use App\registrasi;
use App\tb_kelas;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        $user = User::with('tb_kelas')->find(Auth::user()->id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $filepath = 'images/user/';
        if ($request->input('nama')) {
            $user->nama = $request->input('nama');

        }
        if ($request->input('email')) {
            $user->email = $request->input('email');

        }
        if ($request->input('tgl_lahir')) {
            $user->tgl_lahir = $request->input('tgl_lahir');

        }
        if ($request->input('no_hp')) {
            $user->no_hp = $request->input('no_hp');

        }
        if ($request->input('alamat')) {
            $user->alamat = $request->input('alamat');

        }
        if ($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }
        if ($request->input('kelas_id')) {
            $user->kelas_id = $request->input('kelas_id');
        }
        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotos = $foto->getClientOriginalName();
            $foto->move($filepath, $fotos);

            $user->foto = $fotos;
        }
        $user->save();
        return $this->baseResponse(true, "berhasil", $user);
    }


}
