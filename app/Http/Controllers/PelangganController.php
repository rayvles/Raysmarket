<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggan;

class PelangganController extends Controller
{
    
    public function index() {
        $customer = pelanggan::all();
        return view('admin.tablepelanggan', compact(
            'customer'
        ));
    }

    public function store(Request $request) {

        $request->validate([
            'nama' => 'required|unique:pelanggan,nama',
            'no_telp' => 'required|unique:pelanggan,no_telp',
            'email' => 'required|unique:pelanggan,email'
        ]);

        $kode_pelanggan = pelanggan::get_code();

        $barangs = pelanggan::create([
            'kode_pelanggan' => $kode_pelanggan,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email
            
        ]);

        return redirect('pelanggan');


    }

    public function update(Request $request, $id)
    {
        $pelanggan = pelanggan::find($id);
        $request->validate([
            'nama' => 'required|unique:pelanggan,nama,'. $pelanggan->id,
            'no_telp' => 'required|unique:pelanggan,no_telp,'. $pelanggan->id,
            'email' => 'required|unique:pelanggan,email,'. $pelanggan->id
        ]);

        
        $pelanggan->nama = $request->nama;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->no_telp = $request->no_telp;
        $pelanggan->email = $request->email;
        $pelanggan->save();

        return redirect('pelanggan');
    }

    public function destroy($id)
    {
        $pelanggan = pelanggan::find($id);
        $pelanggan->delete();
        return redirect('pelanggan');
    }
}
