<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasok extends Model
{
    use HasFactory;
    protected $table = "pemasok";
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_pemasok', 'nama_pemasok', 'alamat', 'kota', 'no_telp'
    ];


    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }

    /**
     * Cek apakah pemasok tersebut bisa dihapus atau tidak
     *
     * @return boolean
     */
    public function canDelete()
    {
        return !$this->pembelian()->exists();
    }

    public static function get_code()
    {
        $no_urut = self::selectRaw("IFNULL(MAX(SUBSTRING(`kode_pemasok`,8,5)),0) + 1 AS no_urut")->whereRaw("SUBSTRING(`kode_pemasok`,2,4) = '" . date('Y') . "'")->orderBy('no_urut')->first()->no_urut;
        $kode_pemasok = "P" . date("Ym") . sprintf("%'.05d", $no_urut);
        return $kode_pemasok;
    }
}
