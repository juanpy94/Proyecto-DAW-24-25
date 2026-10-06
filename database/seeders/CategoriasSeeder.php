<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('categorias')->insert([
            'nombre' => 'Coche'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Furgoneta'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Tractor'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Vibro'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Motosierra'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Sopladora'
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Desbrozadora'
        ]);

    }
}
