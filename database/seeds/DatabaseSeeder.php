<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(JenisTableSeeder::class);
        $this->call(KategoriTableSeeder::class);
        $this->call(SatuanTableSeeder::class);
        $this->call(ObatsTableSeeder::class);
    }
}
