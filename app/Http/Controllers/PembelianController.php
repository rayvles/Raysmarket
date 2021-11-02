<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\pemasok;
use App\Models\pembelian;
use App\Models\pembeliandetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PembelianController extends Controller
{
    public function index()
    {
        return view('admin.pembelian.index');
    }

    public function data()
    {
        $pembelian = Pembelian::with('detail')->latest()->get();

        return DataTables::of($pembelian)
            ->addIndexColumn()
            ->addColumn('total_bayar', function ($pembelian) {
                return 'Rp ' . number_format($pembelian->total);
            })
            ->addColumn('nama_user', function ($pembelian) {
                return $pembelian->user->name;
            })
            ->addColumn('total_barang', function ($pembelian) {
                return $pembelian->detail->count();
            })
            ->addColumn('nama_pemasok', function ($pembelian) {
                return $pembelian->pemasok->nama_pemasok;
            })
            ->addColumn('action', function ($pembelian) {
                $buttons = '<button type="button" class="button-lihat-detail btn btn-sm btn-info mr-1" title="Lihat Detail" data-toggle="modal" data-target="#modalDetailPembelian" data-pembelian-id="' . $pembelian->id . '" data-kode-pembelian="' . $pembelian->kode_masuk . '">Lihat Detail</button>';
                return $buttons;
            })->rawColumns(['action'])->make(true);
    }

    public function detail_data($id)
    {
        $pembelian = Pembelian::with('detail')->find($id);
        $detail = $pembelian->detail;

        return DataTables::of($detail)
            ->addIndexColumn()
            ->addColumn('kode_barang', function ($detail) {
                return $detail->barang->kode_barang;
            })
            ->addColumn('nama_barang', function ($detail) {
                return $detail->barang->nama_barang;
            })
            ->addColumn('jenis_produk', function ($detail) {
                return $detail->barang->produk->nama_produk;
            })
            ->editColumn('harga_beli', function ($detail) {
                return 'Rp ' . number_format($detail->harga_beli);
            })
            ->editColumn('sub_total', function ($detail) {
                return 'Rp ' . number_format($detail->sub_total);
            })->make(true);
    }

    public function create()
    {
        $barang = Barang::with('produk')->get();
        $pemasok = Pemasok::get();
        return view('admin.pembelian.pembelian_baru', [
            'barang' => $barang,
            'pemasok' => $pemasok
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pemasok_id' => 'required|exists:pemasok,id',
            'barang_id' => 'required|array'
        ]);

        $kode_masuk = Pembelian::buat_kode_pembelian();
        $tanggal_masuk = date('Y-m-d');
        $pemasok_id = $request->pemasok_id;
        $user_id = 3;
        $arr_jumlah = $request->jumlah;
        $arr_barang_id = $request->barang_id;
        $arr_harga_beli = $request->harga_beli;

        $total_harga = collect($arr_harga_beli)->reduce(function ($total, $harga_beli, $index) use ($arr_jumlah) {
            $harga_beli = (int) $harga_beli ?? 0;
            $jumlah = (int) $arr_jumlah[$index] ?? 0;
            return $total + $harga_beli * $jumlah;
        });

        $pembelian = Pembelian::create([
            'kode_masuk' => $kode_masuk,
            'tanggal_masuk' => $tanggal_masuk,
            'pemasok_id' => $pemasok_id,
            'user_id' => $user_id,
            'total' => $total_harga,
        ]);

        foreach ($arr_barang_id as $index => $barang_id) {
            $harga_beli = (int) $request->harga_beli[$index] ?? 0;
            $jumlah = (int) $request->jumlah[$index] ?? 0;

            if ($jumlah !== 0) {
                $detail = $pembelian->detail()->create([
                    'barang_id' => $barang_id,
                    'harga_beli' => $harga_beli,
                    'jumlah' => $jumlah,
                    'sub_total' => $harga_beli * $jumlah
                ]);

                $detail->barang()->increment('stok', $jumlah);
            }
        };

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
