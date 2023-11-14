<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_pengumpulan extends Model
{
    use HasFactory;

    public function tugas()
    {
        return $this->belongsTo(Tb_tugas_siswa::class, 'id_tugas');
    }
}
