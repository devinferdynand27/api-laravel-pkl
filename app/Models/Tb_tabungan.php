<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_tabungan extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->belongsTo(Tb_siswa::class, 'id_siswa');
    }
}
