<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $fillable = ['karyawan_id', 'jumlah_gaji', 'bulan_tahun'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
