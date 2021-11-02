<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {

        $datas = produk::all();
        return view('admin.tableproduk', compact(
            'datas'
        ));
    }

    public function create()
    {

        $produk = new produk;
       
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_produk' => 'required|unique:produk,nama_produk',
            
        ]);

        $produk = new produk;
        $produk->id = $request->id;
        $produk->nama_produk = $request->nama_produk;
        $produk->save();
        return redirect('produk');
    }

    public function edit($id)
    {
        $produk = produk::find($id);
       
    }

    public function update(Request $request, $id)
    {
        $produk = produk::find($id);
        $request->validate([
            'nama_produk' => 'required|unique:produk,nama_produk,'. $produk->id
            
        ]);

        
        $produk->nama_produk = $request->nama_produk;
        $produk->save();

        return redirect('produk');
    }

    public function destroy($id)
    {
        $produk = produk::find($id);
        $produk->delete();
        return redirect('produk');
    }
}
