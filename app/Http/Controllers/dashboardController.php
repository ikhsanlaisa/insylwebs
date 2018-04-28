<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
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
        return view('admin.index');

    }

    public function dataadmin()
    {
        $user = User::where('roles', '=', 1)->get();
        return view('admin.dataadmin')->with('user', $user);
    }

    public function datamahasiswa()
    {
        $user = User::where('roles', '=', 2)->get();
        return view('admin.datamahasiswa')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = User::where('id', $id)->get();
        return json_encode($admin);
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
        $admin = User::find($id);
        $admin->nama = $request->input('user');
        $admin->email = $request->input('email');
        $result = $admin->save();
        if ($result){
            return redirect('/dataadmin')->with(['message' => 'Berhasil Update Admin']);
        }else{
            return redirect('/dataadmin')->with(['message' => 'Gagal Update Admin']);
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
        $user = User::find($id)->first();
        $result = $user->delete();
        if ($result){
            return redirect('/dataadmin')->with(['message' => 'Berhasil Hapus Admin']);
        }else{
            return redirect('/dataadmin')->with(['message' => 'Gagal Hapus Admin']);
        }
    }
}
