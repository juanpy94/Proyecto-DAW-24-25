<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('facturas')->insert([
            'fecha_emision' => '2023-03-09',
            'estado' => 'pagada',
            'total_factura' => '224.68',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-05-18',
            'estado' => 'pagada',
            'total_factura' => '115.34',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-05-26',
            'estado' => 'pagada',
            'total_factura' => '233.61',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-05-29',
            'estado' => 'pagada',
            'total_factura' => '356.44',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-06-01',
            'estado' => 'pagada',
            'total_factura' => '302.50',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-05-31',
            'estado' => 'pagada',
            'total_factura' => '162.84',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-07-04',
            'estado' => 'pagada',
            'total_factura' => '563.93',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-12-14',
            'estado' => 'pagada',
            'total_factura' => '21.18',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-12-18',
            'estado' => 'pagada',
            'total_factura' => '30.02',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2023-12-28',
            'estado' => 'pagada',
            'total_factura' => '18.15',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2024-05-20',
            'estado' => 'pagada',
            'total_factura' => '109.34',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2024-05-29',
            'estado' => 'pagada',
            'total_factura' => '2061.24',
            'id_usuario' => '3'
        ]);

        DB::table('facturas')->insert([
            'fecha_emision' => '2024-07-02',
            'estado' => 'pendiente',
            'total_factura' => '17.55',
            'id_usuario' => '3'
        ]);

    }
}
