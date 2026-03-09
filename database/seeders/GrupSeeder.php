<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  


class GrupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('grups')->insert([
        [
            'nom' => '1DAM', 
            'aula' => 'A023', 
            'professor_id' => '2', 

        ],
        [
            'nom' => '2DAW', 
            'aula' => 'A027', 
            'professor_id' => '1', 
        ]

        ]);
    }
}
