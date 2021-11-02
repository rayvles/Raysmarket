<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\produk;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {

       return view('admin.tablebarang',[
            'barang' => barang::all(),
            'produk' => produk::all(),
       ]);
    }

    public function create() {

    }

    public function store(Request $request) {

        $kode_barang = barang::get_code();

        $barangs = Barang::create([
            'kode_barang' => $kode_barang,
            'produk_id' => $request->produk_id,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok
        ]);

        return redirect('barang');


    }

    public function update(Request $request, $id)
    {
        $barang = barang::find($id);
        $request->validate([
            'produk_id' => 'required|unique:barang,produk_id,'. $barang->id
            
        ]);

        
        $barang->produk_id = $request->produk_id;
        $barang->nama_barang = $request->nama_barang;
        $barang->satuan = $request->satuan;
        $barang->harga_jual = $request->harga_jual;
        $barang->stok = $request->stok;
        $barang->save();

        return redirect('barang');
    }

    public function destroy($id)
    {
        $barang = barang::find($id);
        $barang->delete();
        return redirect('barang');
    }
   
}
