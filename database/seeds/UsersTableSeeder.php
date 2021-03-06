<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Rizky',
            'role_id' => 1,
            'email' => 'admin@mail.com',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat' => 'Jalan Jalan',
            'gambar' => 'img/avatar/avatar-1.png',
            'no_telp' => '082123126531',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'name' => 'yolanda',
            'role_id' => 2,
            'email' => 'apoteker@mail.com',
            'jenis_kelamin' => 'wanita',
            'alamat' => 'Jalan buntu',
            'gambar' => 'img/avatar/avatar-4.png',
            'no_telp' => '0831265312312',
            'password' => bcrypt('secret')
        ]);

        factory(User::class, 15)->create();
    }
}
