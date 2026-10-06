<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Vehiculos_maquinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Renault',
            'modelo' => 'Clio',
            'matricula' => '4520DDR',
            'ano' => '2004',
            'id_categoria' => '1',
            'id_usuario' => '7'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Seat',
            'modelo' => 'León',
            'matricula' => '9779CBX',
            'ano' => '2002',
            'id_categoria' => '1',
            'id_usuario' => '7'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Opel',
            'modelo' => 'Corsa',
            'matricula' => '4526BYR',
            'ano' => '2002',
            'id_categoria' => '1',
            'id_usuario' => '8'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Seat',
            'modelo' => 'León',
            'matricula' => '2546KLB',
            'ano' => '2018',
            'id_categoria' => '1',
            'id_usuario' => '8'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Peugeot',
            'modelo' => '2008',
            'matricula' => '6545LRY',
            'ano' => '2020',
            'id_categoria' => '1',
            'id_usuario' => '9'
        ]);

        

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'New Holland',
            'modelo' => 'L95',
            'matricula' => 'E5846BCF',
            'ano' => '2016',
            'id_categoria' => '3',
            'id_usuario' => '10'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Stihl',
            'modelo' => 'SP452',
            'ano' => '2023',
            'id_categoria' => '4',
            'id_usuario' => '10'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Stihl',
            'modelo' => 'MS172',
            'ano' => '2024',
            'id_categoria' => '5',
            'id_usuario' => '11'
        ]);
        
        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Stihl',
            'modelo' => 'BR500',
            'ano' => '2020',
            'id_categoria' => '6',
            'id_usuario' => '12'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Ford',
            'modelo' => 'Fiesta',
            'matricula' => '2184JLK',
            'ano' => '2018',
            'id_categoria' => '1',
            'id_usuario' => '13'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'John Deere',
            'modelo' => '6520',
            'matricula' => '5468JDE',
            'ano' => '2020',
            'id_categoria' => '3',
            'id_usuario' => '14'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Stihl',
            'modelo' => 'FS120',
            'ano' => '2019',
            'id_categoria' => '7',
            'id_usuario' => '14'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Citroën',
            'modelo' => 'C4',
            'matricula' => '2045LKJ',
            'ano' => '2022',
            'id_categoria' => '1',
            'id_usuario' => '15'
        ]);

        DB::table('vehiculos_maquinarias')->insert([
            'marca' => 'Audi',
            'modelo' => 'A3',
            'matricula' => '1546MBB',
            'ano' => '2024',
            'id_categoria' => '1',
            'id_usuario' => '15'
        ]);

    }
}
