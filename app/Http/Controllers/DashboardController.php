<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_kategori;
use App\tbl_produk;
use App\tbl_stok;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get count produk
        $tbl_produk = tbl_produk::all()->count();

        // get count kategori
        $tbl_kategori = tbl_kategori::all()->count();

        // get produk join kategori and stok
        $all_produk = DB::table('tbl_produks')
                    ->join('tbl_kategoris', 'tbl_produks.id_kategori', '=', 'tbl_kategoris.id_kategori')
                    ->join('tbl_stoks', 'tbl_produks.id_produk', '=', 'tbl_stoks.id_produk')
                    ->get();

        return view('dashboard', [
            'tbl_produk' => $tbl_produk,
            'tbl_kategori' => $tbl_kategori,
            'all_produk' => $all_produk
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
