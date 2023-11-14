<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_hari extends Model
{
    protected $table = 'tb_haris';
    protected $fillable = ['hari'];

    use HasFactory;
}
