<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReparacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-03-03',
            'fecha_inicio' => '2023-03-07',
            'fecha_fin' => '2023-03-08',
            'descripcion' => 'Cambiar cubiertas traseras y cambiar las 2 matriculas',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '1'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-05-10',
            'fecha_inicio' => '2023-05-12',
            'fecha_fin' => '2023-05-12',
            'descripcion' => 'Revisar circuito del aire acondicionado y cargar aire para un correcto funcionamiento',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '1'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-05-17',
            'fecha_inicio' => '2023-05-22',
            'fecha_fin' => '2023-05-22',
            'descripcion' => 'Cambiar aceite motor, filtros, etc.',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '2'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-05-18',
            'fecha_inicio' => '2023-05-23',
            'fecha_fin' => '2023-05-23',
            'descripcion' => 'Cambiar aceite y mirar niveles para revisión para la ITV',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '3'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-05-22',
            'fecha_inicio' => '2023-05-25',
            'fecha_fin' => '2023-05-26',
            'descripcion' => 'Arreglar golpe trasero y pintar',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '4'
        ]);
        
        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-05-23',
            'fecha_inicio' => '2023-05-25',
            'fecha_fin' => '2023-05-25',
            'descripcion' => 'Cargar aire acondicionado',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '5'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-06-02',
            'fecha_inicio' => '2023-06-26',
            'fecha_fin' => '2023-06-29',
            'descripcion' => 'Cambiar batería, rodamiento, cambiar aceite y filtros, mirar para ITV y pasar ITV',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '6'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-12-04',
            'fecha_inicio' => '2023-12-11',
            'fecha_fin' => '2023-12-11',
            'descripcion' => 'Limpiar carburador, poner filtro y regularlo, cambiar fusible',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '7'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-12-05',
            'fecha_inicio' => '2023-12-14',
            'fecha_fin' => '2023-12-14',
            'descripcion' => 'Comprobar fallo y poner filtro de gasolina nuevo',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '8'
        ]);
        
        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2023-12-14',
            'fecha_inicio' => '2023-12-19',
            'fecha_fin' => '2023-12-19',
            'descripcion' => 'Montar carburador nuevo y regularlo, regular cable de gas',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '9'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-05-08',
            'fecha_inicio' => '2024-05-15',
            'fecha_fin' => '2024-05-16',
            'descripcion' => 'Mirar para ITV y pasar ITV',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '10'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-05-16',
            'fecha_inicio' => '2024-05-22',
            'fecha_fin' => '2024-05-23',
            'descripcion' => 'Cambiar cubiertas, poner válvulas tubeles y poner sistema integral de nfu',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '11'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-06-24',
            'fecha_inicio' => '2024-06-27',
            'fecha_fin' => '2024-06-27',
            'descripcion' => 'Mirar fallo y regular el carburador',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '12'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-07-04',
            'fecha_inicio' => '2024-07-09',
            'fecha_fin' => '2024-07-09',
            'descripcion' => 'Revisar luces y poner nuevas',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '13'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-07-08',
            'fecha_inicio' => '2024-07-11',
            'fecha_fin' => '2024-07-12',
            'descripcion' => 'Comprobar avería de luces, hacer diagnosis, comprobar fallo de la tercera luz de freno',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '14'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-07-08',
            'fecha_inicio' => '2024-07-12',
            'fecha_fin' => '2024-07-12',
            'descripcion' => 'Pegar punta de la vara',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '7'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-07-10',
            'fecha_inicio' => '2024-07-15',
            'fecha_fin' => '2024-07-15',
            'descripcion' => 'Afilar cadena',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '8'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'completado',
            'fecha_entrada' => '2024-07-15',
            'fecha_inicio' => '2024-07-16',
            'fecha_fin' => '2024-07-16',
            'descripcion' => 'Cambiar cubiertas delanteras',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '11'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'en proceso',
            'fecha_entrada' => '2024-12-10',
            'fecha_inicio' => '2024-12-16',
            'descripcion' => 'Comprobar guardapolvos palier y sustituir',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '1'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'en proceso',
            'fecha_entrada' => '2024-12-10',
            'fecha_inicio' => '2024-12-16',
            'descripcion' => 'Sustituir cañonera por una nueva',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '7'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'en proceso',
            'fecha_entrada' => '2024-12-10',
            'fecha_inicio' => '2024-12-16',
            'descripcion' => 'Cambiar aceite y filtros',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '14'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'asignado',
            'fecha_entrada' => '2024-12-11',
            'descripcion' => 'Cambiar kit de embrague y volante bimasa',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '3'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'asignado',
            'fecha_entrada' => '2024-12-12',
            'descripcion' => 'Comprobar cerradura puerta delantera izquierda',
            'id_usuario' => '4',
            'id_vehiculo_maquina' => '13'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'asignado',
            'fecha_entrada' => '2024-12-12',
            'descripcion' => 'Mantenimiento y puesta a punto',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '7'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'asignado',
            'fecha_entrada' => '2024-12-16',
            'descripcion' => 'Limpiar carburado y cambiar filtro gasolina',
            'id_usuario' => '5',
            'id_vehiculo_maquina' => '9'
        ]);

        DB::table('reparaciones')->insert([
            'estado' => 'asignado',
            'fecha_entrada' => '2024-12-16',
            'descripcion' => 'Cambiar radiador',
            'id_usuario' => '6',
            'id_vehiculo_maquina' => '11'
        ]);

    }
}
