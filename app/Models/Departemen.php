<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $fillable = ['nama_departemen'];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
