<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Obat Keras',
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Obat Bebas',
        ]);
        DB::table('kategoris')->insert([
            'nama_kategori' => 'Obat Narkotika',
        ]);
    }
}
