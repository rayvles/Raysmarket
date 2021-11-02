<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = "produk";
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'nama_produk'
    ];

    public function barang(){
        return $this->hasMany(barang::class);
    }

   
    
}
