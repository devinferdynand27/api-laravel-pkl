<?php

namespace Database\Seeders;

use App\Models\Tb_hari;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_haris')->insert([
            ['hari' => 'Senin'],
            ['hari' => 'Selasa'],
            ['hari' => 'Rabu'],
            ['hari' => 'Kamis'],
            ['hari' => 'Jumat'],
            ['hari' => 'Sabtu']

        ]);
    }
}
