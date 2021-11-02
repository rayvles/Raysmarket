<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang', 'produk_id', 'nama_barang', 'satuan', 'harga_jual', 'stok'
    ];

    public function produk(){
        return $this->belongsTo(produk::class);
    }

    public function pembelian(){
        return $this->hasMany(PembelianDetail::class);
    }

    public function penjualan(){
        return $this->hasMany(PenjualanDetail::class);
    }
    

    public static function get_code()
    {
        $no_urut = self::selectRaw("IFNULL(MAX(SUBSTRING(`kode_barang`,8,5)),0) + 1 AS no_urut")->whereRaw("SUBSTRING(`kode_barang`,2,4) = '" . date('Y') . "'")->orderBy('no_urut')->first()->no_urut;
        $kode_barang = "B" . date("Ym") . sprintf("%'.05d", $no_urut);
        return $kode_barang;
    }
}
