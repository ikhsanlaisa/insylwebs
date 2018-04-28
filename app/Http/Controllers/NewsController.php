<?php

namespace App\Http\Controllers;

use App\news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = news::all();
        return view("admin.news")->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tambah_news");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filepath = 'images/news/';

        $foto = $request->file('foto');
        $fotos = $foto->getClientOriginalName();
        $foto->move($filepath, $fotos);

        $news = new news();
        $news->judul = $request->input('judul');
        $news->description = $request->input('description');
        $news->foto = $fotos;
        $result = $news->save();
        if ($result) {
            return redirect('/tambah_news')->with(['message' => 'Berhasil Tambah News']);
        }
        return redirect('/tambah_news')->with(['message' => 'Gagal Tambah News']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = news::where('id', $id)->get();
        return json_encode($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $news = news::find($id);
        $filepath = 'images/kontak/';

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotos = $foto->getClientOriginalName();
            $foto->move($filepath, $fotos);

            $news->foto = $fotos;
        }
        $news->judul = $request->input('judul');
        $news->description = $request->input('description');
//        var_dump($request->input('foto'));
//        }
        $result = $news->save();
        if ($result) {
            return redirect('/datanews')->with(['message' => 'Berhasil update News']);
        }
        return redirect('/datanews')->with(['message' => 'Gagal update News']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = news::find($id);
        $result = $news->delete();
        if ($result) {
            return redirect('/datanews')->with(['message' => 'Berhasil hapus News']);
        }
        return redirect('/datanews')->with(['message' => 'Gagal hapus News']);
    }
}
