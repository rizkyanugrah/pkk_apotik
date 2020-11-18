<?php

use Illuminate\Database\Seeder;

class SatuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuans')->insert([
            'nama_satuan' => 'Strip',
        ]);
        DB::table('satuans')->insert([
            'nama_satuan' => 'Botol',
        ]);
        DB::table('satuans')->insert([
            'nama_satuan' => 'Keping',
        ]);
    }
}
