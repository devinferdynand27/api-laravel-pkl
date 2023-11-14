<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_tugas_siswa extends Model
{
    use HasFactory;

    public function hari()
    {
        return $this->belongsTo(Tb_hari::class, 'id_hari');
    }
    public function kelas()
    {
        return $this->belongsTo(Tb_kelas::class, 'id_kelas');
    }
    public function mapel()
    {
        return $this->belongsTo(Tb_mapel::class, 'id_mapel');
    }
}
