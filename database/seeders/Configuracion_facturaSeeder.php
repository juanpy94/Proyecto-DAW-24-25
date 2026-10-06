<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConfiguracionFactura;


class Configuracion_facturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfiguracionFactura::create([
            'iva' => '21',
            'precio_mano_obra' => '30'
        ]);
        
    }
}
