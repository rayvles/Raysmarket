<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = "pelanggan";
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_pelanggan', 'nama', 'alamat', 'no_telp', 'email'
    ];

    public static function get_code()
    {
        $no_urut = self::selectRaw("IFNULL(MAX(SUBSTRING(`kode_pelanggan`,8,5)),0) + 1 AS no_urut")->whereRaw("SUBSTRING(`kode_pelanggan`,2,4) = '" . date('Y') . "'")->orderBy('no_urut')->first()->no_urut;
        $kode_pelanggan = "C" . date("Ym") . sprintf("%'.05d", $no_urut);
        return $kode_pelanggan;
    }
}
