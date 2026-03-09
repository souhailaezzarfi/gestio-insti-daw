<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  


class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('professors')->insert([
        [
            'nom' => 'David', 
            'cognoms' => 'Martínez Escachx', 
            'email' => 'david@test.cat', 
            'foto' => null,

        ],
        [
            'nom' => 'Roma', 
            'cognoms' => 'Bejar Vilà', 
            'email' => 'roma@test.cat', 
            'foto' => null,

        ]

        ]);
    }
}
