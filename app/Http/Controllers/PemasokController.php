<?php

namespace App\Http\Controllers;

use App\Models\pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index() {
        $pemasok = pemasok::all();
        return view('admin.tablepemasok', compact(
            'pemasok'
        ));
    }

    public function store(Request $request) {

        $request->validate([
            'nama_pemasok' => 'required|unique:pemasok,nama_pemasok',
            'no_telp' => 'required|unique:pemasok,no_telp',
        ]);

        $kode_pemasok = pemasok::get_code();

        $barangs = pemasok::create([
            'kode_pemasok' => $kode_pemasok,
            'nama_pemasok' => $request->nama_pemasok,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'no_telp' => $request->no_telp
            
        ]);

        return redirect('pemasok');


    }

    public function update(Request $request, $id)
    {
        $pemasok = pemasok::find($id);
        $request->validate([
            'nama_pemasok' => 'required|unique:pemasok,nama_pemasok,'. $pemasok->id,
            'no_telp' => 'required|unique:pemasok,no_telp,'. $pemasok->id,
        ]);

        
        $pemasok->nama_pemasok = $request->nama_pemasok;
        $pemasok->alamat = $request->alamat;
        $pemasok->kota = $request->kota;
        $pemasok->no_telp = $request->no_telp;
        $pemasok->save();

        return redirect('pemasok');
    }

    public function destroy($id)
    {
        $pemasok = pemasok::find($id);
        $pemasok->delete();
        return redirect('pemasok');
    }
}
