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
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret')
        ]);

        DB::table('users')->insert([
            'name' => 'Apoteker',
            'role_id' => 2,
            'email' => 'apoteker@mail.com',
            'password' => bcrypt('secret')
        ]);

        factory(User::class, 15)->create();
    }
}
