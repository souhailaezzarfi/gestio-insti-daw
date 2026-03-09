<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  


class AlumneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('alumnes')->insert([
        [
            'nom' => 'Souhaila', 
            'cognoms' => 'Ezzarfi', 
            'dni' => '11111111S', 
            'data_naixement' => '2002-07-25', 
            'telefon' => '612345678', 
            'grup_id' => 2, 

        ],
        [
            'nom' => 'Ricard', 
            'cognoms' => 'Vergés Maturana', 
            'dni' => '22222222R', 
            'data_naixement' => '2000-01-13', 
            'telefon' => '631987654', 
            'grup_id' => 2, 

        ],
        [
            'nom' => 'Laura', 
            'cognoms' => 'Martínez López', 
            'dni' => '33333333L', 
            'data_naixement' => '2005-04-12', 
            'telefon' => '612654321', 
            'grup_id' => 1, 

        ]


        ]);
    }
}
