<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_kategori;
use App\tbl_produk;

class KategoriController extends Controller
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
        $tbl_kategori = tbl_kategori::all();
        return view('inventory.kategori', ['tbl_kategori' => $tbl_kategori]);
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
        // validasi jika kosong
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        tbl_kategori::create($request->all());
        return redirect('/kategori')->with('status', 'Item added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $tbl_kategori = tbl_kategori::where('id_kategori', $id)->first();
        $tbl_kategori->nama_kategori = $request->nama_kategori;
        $tbl_kategori->update();
        return redirect('/kategori')->with('status', 'Item updated has been successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbl_kategori = tbl_kategori::where('id_kategori', $id)->first();
        $cek_produk = tbl_produk::where('id_kategori', $id)->first();

        // cek produk yang terelasi ke kategori
        if ( empty($cek_produk) ) {
            $tbl_kategori->delete();
            return redirect('/kategori')->with('status', 'Item deleted has been successfully!');
        } else {
            return redirect('/kategori')->with('status2', 'Failed, please check produk!');
        }
    }
}
