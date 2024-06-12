<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;




class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uid' => '101012390439',
            'firstName' => 'Fadlan',
            'lastName' => 'Iman',
            'email' => 'fadlan@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '085359778899',
            'level' => '1',
        ]);

        DB::table('users')->insert([
            'uid' => '101012390435',
            'firstName' => 'Sohibul',
            'lastName' => 'Marpaung',
            'email' => 'sohibul@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '085359778899',
            'level' => '2',
        ]);
        DB::table('users')->insert([
            'uid' => '101012390432',
            'firstName' => 'Abdi',
            'lastName' => 'Akbar',
            'email' => 'akbar@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '085359778899',
            'level' => '2',
        ]);

        DB::table('users')->insert([
            'uid' => '101012390431',
            'firstName' => 'Ardi',
            'lastName' => 'Prayoga',
            'email' => 'ardi@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '085359778899',
            'level' => '3',
        ]);
    }
}
