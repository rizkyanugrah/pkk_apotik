<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ObatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $aturan_minum = ['3x1', '2x1'];
        $satuan = ['Gram', 'PCS'];

        for ($i = 1; $i <= 10; $i++) {
            $tanggal_kadaluarsa = Carbon::createFromDate(mt_rand(date('Y') - 2, date('Y') + 4), mt_rand(1, 12), mt_rand(1, 31));

            DB::table('obats')->insert([
                'supplier_id' => mt_rand(1, 10),
                'nama_obat' => $faker->text(10),
                'aturan_minum' => $aturan_minum[mt_rand(0, count($aturan_minum) - 1)],
                'satuan' => $satuan[mt_rand(0, count($satuan) - 1)],
                'harga' => mt_rand(100000, 200000),
                'is_expired' => $tanggal_kadaluarsa <= date('Y-m-d') ? 1 : 0,
                'tanggal_kadaluarsa' => $tanggal_kadaluarsa,
                'gambar' => 'assets/images/obat/default.png',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}