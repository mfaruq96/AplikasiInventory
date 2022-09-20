<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_produk;
use App\tbl_kategori;
use App\tbl_stok;

class ProdukController extends Controller
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
        $tbl_produk = tbl_produk::all();

        // join tabel produks dengan kategori
        $all_produk = DB::table('tbl_produks')
                    ->join('tbl_kategoris', 'tbl_produks.id_kategori', '=', 'tbl_kategoris.id_kategori')
                    ->get();

        return view('inventory.produk',[
            'tbl_kategori' => $tbl_kategori,
            'tbl_produk' => $all_produk
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
        // validasi jika kosong
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'kode_produk' => 'required',
            'foto_produk_satu' => 'required',
            'foto_produk_dua' => 'required',
            'foto_produk_tiga' => 'required',
            'tgl_register' => 'required'
        ]);

        // menyimpan data file menjadi variabel
        if( !empty($request->foto_produk_satu) )
        {
            $image_satu = $request->foto_produk_satu;
            $image_dua = $request->foto_produk_dua;
            $image_tiga = $request->foto_produk_tiga;

            $fileName_satu = pathinfo($image_satu->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName_dua = pathinfo($image_dua->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName_tiga = pathinfo($image_tiga->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_foto_satu = $fileName_satu."_".date('d-m-Y-His').".".$image_satu->getClientOriginalExtension();
            $upload_foto_dua = $fileName_dua."_".date('d-m-Y-His').".".$image_dua->getClientOriginalExtension();
            $upload_foto_tiga = $fileName_tiga."_".date('d-m-Y-His').".".$image_tiga->getClientOriginalExtension();

            $des = public_path('images');
            $image_satu->move($des, $upload_foto_satu);
            $image_dua->move($des, $upload_foto_dua);
            $image_tiga->move($des, $upload_foto_tiga);
        }

        // insert ke database
        tbl_produk::create([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'kode_produk' => $request->kode_produk,
            'foto_produk_satu' => $upload_foto_satu,
            'foto_produk_dua' => $upload_foto_dua,
            'foto_produk_tiga' => $upload_foto_tiga,
            'tgl_register' => $request->tgl_register,
        ]);

        $cek_produk = tbl_produk::where('kode_produk', $request->kode_produk)->first();
        $id_produk_new = $cek_produk->id_produk;

        tbl_stok::create([
            'id_produk' => $id_produk_new,
            'jumlah_barang' => 0,
            'tgl_register' => $request->tgl_register
        ]);

        return redirect('/produk')->with('status', 'Item added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = DB::table('tbl_produks')
                        ->join('tbl_kategoris', 'tbl_produks.id_kategori', '=', 'tbl_kategoris.id_kategori')
                        ->where('id_produk', $id)
                        ->first();

        return view('inventory.produk_detail',[
            'tbl_produk' => $produk
        ]);
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
        $tbl_produk = tbl_produk::where('id_produk', $id)->first();

        // menyimpan data file menjadi variabel
        if( !empty($request->foto_produk_satu) )
        {
            $image_satu = $request->foto_produk_satu;
            $image_dua = $request->foto_produk_dua;
            $image_tiga = $request->foto_produk_tiga;

            $fileName_satu = pathinfo($image_satu->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName_dua = pathinfo($image_dua->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName_tiga = pathinfo($image_tiga->getClientOriginalName(), PATHINFO_FILENAME);

            $upload_foto_satu = $fileName_satu."_".date('d-m-Y-His').".".$image_satu->getClientOriginalExtension();
            $upload_foto_dua = $fileName_dua."_".date('d-m-Y-His').".".$image_dua->getClientOriginalExtension();
            $upload_foto_tiga = $fileName_tiga."_".date('d-m-Y-His').".".$image_tiga->getClientOriginalExtension();

            $des = public_path('images');
            $image_satu->move($des, $upload_foto_satu);
            $image_dua->move($des, $upload_foto_dua);
            $image_tiga->move($des, $upload_foto_tiga);
        }

        // update data
        $tbl_produk->id_kategori = $request->id_kategori;
        $tbl_produk->nama_produk = $request->nama_produk;
        $tbl_produk->kode_produk = $request->kode_produk;
        $tbl_produk->foto_produk_satu = $upload_foto_satu;
        $tbl_produk->foto_produk_dua = $upload_foto_dua;
        $tbl_produk->foto_produk_tiga = $upload_foto_tiga;
        $tbl_produk->tgl_register = $request->tgl_register;
        $tbl_produk->update();

        return redirect('/produk')->with('status', 'Item updated has been successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbl_produk = tbl_produk::where('id_produk', $id)->first();
        $cek_stok = tbl_stok::where('id_produk', $id)->first();

        // cek produk yang terelasi ke stok
        if ( empty($cek_stok) ) {
            $tbl_produk->delete();
            return redirect('/produk')->with('status', 'Item deleted has been successfully!');
        } else {
            return redirect('/produk')->with('status2', 'Failed, please check stock produk!');
        }
    }
}
