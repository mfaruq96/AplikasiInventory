<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_stok;
use App\tbl_produk;

class StokController extends Controller
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
        $tbl_produk = tbl_produk::all();
        $tbl_stok = tbl_stok::all();
        $all_produk = DB::table('tbl_produks')
                    ->join('tbl_kategoris', 'tbl_produks.id_kategori', '=', 'tbl_kategoris.id_kategori')
                    ->join('tbl_stoks', 'tbl_produks.id_produk', '=', 'tbl_stoks.id_produk')
                    ->get();
                    // dd($all);

        return view('inventory.stok',[
            'tbl_produk' => $tbl_produk,
            'tbl_stok' => $tbl_stok,
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
        // ambil id produk dari form
        $check = $request->id_produk;

        // cek id produk pada tabel stok
        $check_stok = tbl_stok::where('id_produk', $check)->first();
        if ( !empty($check_stok) ) {
            DB::table('tbl_stoks')
                    ->where('id_produk', $check)
                    ->update([
                        'jumlah_barang' => $check_stok->jumlah_barang + $request->jumlah_barang,
                        'tgl_register' => $request->tgl_register
                    ]);
        } else {
            $request->validate([
                'id_produk' => 'required',
                'jumlah_barang' => 'required',
                'tgl_register' => 'required'
            ]);
            tbl_stok::create($request->all());
        };

        return redirect('/stok')->with('status', 'Item added successfully!');
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
        $tbl_stok = tbl_stok::where('id_stok', $id);
        $tbl_stok->delete();
        return redirect('/stok')->with('status', 'Item deleted has been successfully!');
    }
}
