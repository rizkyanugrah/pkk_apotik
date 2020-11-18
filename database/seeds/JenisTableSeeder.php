<?php

use Illuminate\Database\Seeder;

class JenisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis')->insert([
            'nama_jenis' => 'Alergi',
        ]);
        DB::table('jenis')->insert([
            'nama_jenis' => 'Perut',
        ]);
        DB::table('jenis')->insert([
            'nama_jenis' => 'Kepala',
        ]);
    }
}
