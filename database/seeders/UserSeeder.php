<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
        [
            'name' => 'usauri1',
            'email' => 'usuari1@test.cat',
            'password' => bcrypt('123'),
            'rol' => 'admin'


        ],
        [
            'name' => 'usauri2',
            'email' => 'usuari2@test.cat',
            'password' => bcrypt('123'),
            'rol' => 'professor'

        ],
        [
            'name' => 'usauri3',
            'email' => 'usuari3@test.cat',
            'password' => bcrypt('123'),
            'rol' => 'user'

        ]

        ]);
    }
}
