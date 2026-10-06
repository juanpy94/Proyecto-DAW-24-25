<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Detalles_reparacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cubiertas TRIANGLE 185/55 R15,  valvulas y contrapesado',
            'cantidad' => '2',
            'precio_unidad' => '60.54',
            '%_iva' => '21',
            'iva' => '25.43',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '121.09',
            'id_reparacion' => '1',
            'id_factura' => '1'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Sistema Integral de Gestión de NFU (RD 1619 / 2005)',
            'cantidad' => '2',
            'precio_unidad' => '1.44',
            '%_iva' => '21',
            'iva' => '0.60',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '2.88',
            'id_reparacion' => '1',
            'id_factura' => '1'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Kit fuelle direción',
            'cantidad' => '1',
            'precio_unidad' => '11.72',
            '%_iva' => '21',
            'iva' => '2.46',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '11.72',
            'id_reparacion' => '1',
            'id_factura' => '1'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Chapas Matrícula',
            'cantidad' => '2',
            'precio_unidad' => '10',
            '%_iva' => '21',
            'iva' => '4.20',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '20',
            'id_reparacion' => '1',
            'id_factura' => '1'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Sustituir guardapolvos de caja de direción (izq.) y poner dos  matriculas nuevas…',
            'cantidad' => '1',
            'precio_unidad' => '30',
            '%_iva' => '21',
            'iva' => '6.30',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '30',
            'id_reparacion' => '1',
            'id_factura' => '1'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Carga aire acondicionado',
            'cantidad' => '1',
            'precio_unidad' => '50.32',
            '%_iva' => '21',
            'iva' => '10.57',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '50.32',
            'id_reparacion' => '2',
            'id_factura' => '2'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Dosis de tapafugas A/A',
            'cantidad' => '1',
            'precio_unidad' => '30',
            '%_iva' => '21',
            'iva' => '6.30',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '30',
            'id_reparacion' => '2',
            'id_factura' => '2'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Revisar circuito del aire, ver fuga por el evaporador interno, cargar aire y echar una dosis de tapafugas inyectado…',
            'cantidad' => '1',
            'precio_unidad' => '15',
            '%_iva' => '21',
            'iva' => '3.15',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '15',
            'id_reparacion' => '2',
            'id_factura' => '2'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Aceite motor TOTAL INEO 5w30',
            'cantidad' => '1',
            'precio_unidad' => '45',
            '%_iva' => '21',
            'iva' => '9.45',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '45',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro aceite',
            'cantidad' => '1',
            'precio_unidad' => '11.57',
            '%_iva' => '21',
            'iva' => '2.43',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '11.57',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro del aire',
            'cantidad' => '1',
            'precio_unidad' => '18.08',
            '%_iva' => '21',
            'iva' => '3.80',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '18.08',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro antipolen',
            'cantidad' => '1',
            'precio_unidad' => '23.79',
            '%_iva' => '21',
            'iva' => '5.00',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '23.79',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro gasoil',
            'cantidad' => '1',
            'precio_unidad' => '49.63',
            '%_iva' => '21',
            'iva' => '10.42',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '49.63',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cambiar aceite motor, filtros de aceite, gasoil, aire y antipolen, revisar niveles, luces, presión ruedas y pastillas de frenos…',
            'cantidad' => '1',
            'precio_unidad' => '45',
            '%_iva' => '21',
            'iva' => '9.45',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '45',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Hacer limpieza antibacterias del habitaculo (***SIN COSTE***)',
            'cantidad' => '0',
            'precio_unidad' => '0',
            '%_iva' => '21',
            'iva' => '0',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '0',
            'id_reparacion' => '3',
            'id_factura' => '3'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Aceite TOTAL INEO 5W30',
            'cantidad' => '1',
            'precio_unidad' => '42.00',
            '%_iva' => '21',
            'iva' => '8.82',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '42.00',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro aceite',
            'cantidad' => '1',
            'precio_unidad' => '16.08',
            '%_iva' => '21',
            'iva' => '3.38',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '16.08',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro gasoil',
            'cantidad' => '1',
            'precio_unidad' => '88.52',
            '%_iva' => '21',
            'iva' => '18.56',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '88.52',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cambiar aceite motor, filtros de aceite, gasoil, limpiar filtro de aire y antipolen, revisar niveles, luces, presión ruedas 
                y pastillas de frenos',
            'cantidad' => '1',
            'precio_unidad' => '45',
            '%_iva' => '21',
            'iva' => '9.45',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '45',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Hacer limpieza antibacterias del habitaculo  *SIN COSTE*',
            'cantidad' => '0',
            'precio_unidad' => '0',
            '%_iva' => '21',
            'iva' => '0',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '0',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Bote limpiador de inyección',
            'cantidad' => '1',
            'precio_unidad' => '20',
            '%_iva' => '21',
            'iva' => '4.20',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '20',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Pila botón litio',
            'cantidad' => '1',
            'precio_unidad' => '3.02',
            '%_iva' => '21',
            'iva' => '0.63',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '3.02',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Mirar para la ITV, revisar holgura y rotulas, probar frenos en el frenometro, revisar guardapolvos, limpiaparabrisas, 
                revisar altura de luces, echar un bote antihumos y hacer descarbonización; Poner una pila al mando de la llave…',
            'cantidad' => '1',
            'precio_unidad' => '45',
            '%_iva' => '21',
            'iva' => '9.45',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '45',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Recibo ITV',
            'cantidad' => '1',
            'precio_unidad' => '34.96',
            '%_iva' => '21',
            'iva' => '7.34',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '34.96',
            'id_reparacion' => '4',
            'id_factura' => '4'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Arreglar golpe trasero; Reparar y Pintar: Aleta trasera izq + Paragolpes tras. + interiores del paragolpes',
            'cantidad' => '1',
            'precio_unidad' => '250',
            '%_iva' => '21',
            'iva' => '52.50',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '250',
            'id_reparacion' => '5',
            'id_factura' => '5'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cargar de aire condiccionado R-1234YF',
            'cantidad' => '1',
            'precio_unidad' => '153.63',
            '%_iva' => '21',
            'iva' => '32.26',
            '%_descuento' => '15',
            'descuento' => '23.05',
            'precio_total' => '153.63',
            'id_reparacion' => '6',
            'id_factura' => '6'
        ]);
        
        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Batería 97Ah 820En',
            'cantidad' => '1',
            'precio_unidad' => '98.00',
            '%_iva' => '21',
            'iva' => '20.58',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '98.00',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Rodamiento',
            'cantidad' => '1',
            'precio_unidad' => '13.92',
            '%_iva' => '21',
            'iva' => '2.92',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '13.92',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Quitar tensor de la correa del aire acondiccionado, ponerle rodamiento nuevo y tensor…',
            'cantidad' => '1',
            'precio_unidad' => '68.00',
            '%_iva' => '21',
            'iva' => '14.28',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '68.00',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Aceite PLUS 50',
            'cantidad' => '12',
            'precio_unidad' => '6',
            '%_iva' => '21',
            'iva' => '15.12',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '72.00',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro aceite',
            'cantidad' => '1',
            'precio_unidad' => '8.45',
            '%_iva' => '21',
            'iva' => '1.77',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '8.45',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Filtro gasoil',
            'cantidad' => '1',
            'precio_unidad' => '9.95',
            '%_iva' => '21',
            'iva' => '2.09',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '9.95',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Aceite hidraulico',
            'cantidad' => '5',
            'precio_unidad' => '5.50',
            '%_iva' => '21',
            'iva' => '5.78',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '27.50',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cambiar aceite motor, filtro de aceite, filtro de gasoil, limpiar filtro aire y cabina, mirar niveles y engrasarlo',
            'cantidad' => '1',
            'precio_unidad' => '68.00',
            '%_iva' => '21',
            'iva' => '14.28',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '68.00',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Mirar para ITV, revisar holgura, rotulas, probar frenos, luces y altura, Limpiar interruptor de freno, volver a poner, 
                mirar averia de faros y poner un fusible',
            'cantidad' => '1',
            'precio_unidad' => '68.00',
            '%_iva' => '21',
            'iva' => '14.28',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '68.00',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'RECIBO ITV',
            'cantidad' => '1',
            'precio_unidad' => '32.24',
            '%_iva' => '21',
            'iva' => '6.77',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '32.24',
            'id_reparacion' => '7',
            'id_factura' => '7'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Limpiar el carburador, poner un filtro de gasolina, regular el carburador; Un filtro de gasolina entregado…',
            'cantidad' => '1',
            'precio_unidad' => '14.50',
            '%_iva' => '21',
            'iva' => '3.05',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '14.50',
            'id_reparacion' => '8',
            'id_factura' => '8'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Poner un fusible nuevo, sacar el suyo (estaba partido)',
            'cantidad' => '1',
            'precio_unidad' => '3.00',
            '%_iva' => '21',
            'iva' => '0.63',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '3.00',
            'id_reparacion' => '8',
            'id_factura' => '8'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Mirar fallo, poner filtro de gasolina (nuevo) y una bujía (nueva), regularla…',
            'cantidad' => '1',
            'precio_unidad' => '24.81',
            '%_iva' => '21',
            'iva' => '5.21',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '24.81',
            'id_reparacion' => '9',
            'id_factura' => '9'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Montarle un carburador (nuevo), regularlo y regular el cable de gas…',
            'cantidad' => '1',
            'precio_unidad' => '15.00',
            '%_iva' => '21',
            'iva' => '3.15',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '15.00',
            'id_reparacion' => '10',
            'id_factura' => '10'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Bote antihumos (Gasolina)',
            'cantidad' => '1',
            'precio_unidad' => '15.00',
            '%_iva' => '21',
            'iva' => '3.15',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '15.00',
            'id_reparacion' => '11',
            'id_factura' => '11'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Mirar para la ITV, revisar holgura y rotulas, probar frenos en el frenometro, revisar guardapolvos, limpiaparabrisas, 
                mirar niveles, luces y altura; Echar un bote antihumos y hacer C.O. (con analizador gases)…',
            'cantidad' => '1',
            'precio_unidad' => '45.00',
            '%_iva' => '21',
            'iva' => '9.45',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '45.00',
            'id_reparacion' => '11',
            'id_factura' => '11'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Recibo ITV',
            'cantidad' => '1',
            'precio_unidad' => '30.36',
            '%_iva' => '21',
            'iva' => '6.38',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '30.36',
            'id_reparacion' => '11',
            'id_factura' => '11'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cubiertas MAXAM MS95 1R 145 A8 480/70 R38, montadas y llenar de agua',
            'cantidad' => '2',
            'precio_unidad' => '820.00',
            '%_iva' => '21',
            'iva' => '344.40',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '1640.00',
            'id_reparacion' => '12',
            'id_factura' => '12'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Valvula tubeles',
            'cantidad' => '1',
            'precio_unidad' => '5.00',
            '%_iva' => '21',
            'iva' => '1.05',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '5.00',
            'id_reparacion' => '12',
            'id_factura' => '12'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Sistema Integral de Gestión de NFU (RD 1619 / 2005)',
            'cantidad' => '1',
            'precio_unidad' => '58.50',
            '%_iva' => '21',
            'iva' => '12.29',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '58.50',
            'id_reparacion' => '12',
            'id_factura' => '12'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Mirar fallo, regular el carburador',
            'cantidad' => '1',
            'precio_unidad' => '14.50',
            '%_iva' => '21',
            'iva' => '3.05',
            '%_descuento' => '0',
            'descuento' => '0',
            'precio_total' => '14.50',
            'id_reparacion' => '13',
            'id_factura' => '13'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Revisar luces, poner una lámpara H7 reforzada, dos lámparas (12v5w) y una 12v21/5…',
            'cantidad' => '1',
            'id_reparacion' => '14'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Ver averia de luces, comprobando alimentaciones y limpiando conexiones de la caja de fusibles del motor',
            'cantidad' => '1',
            'id_reparacion' => '15'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Diagnosis',
            'cantidad' => '1',
            'id_reparacion' => '15'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Hacer diagnosis en le FAP, poner captador de presión del Filtro de particulas, resetearlo, borrar averia, regenerar FAP, probarlo',
            'cantidad' => '1',
            'id_reparacion' => '15'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Ver fallo de la tercera luz de freno, comprobar alimentaciones y cambiar piloto por uno nuevo, quitando y poniendo cantoneras del potón del maletero',
            'cantidad' => '1',
            'id_reparacion' => '15'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'GASOIL',
            'cantidad' => '1',
            'id_reparacion' => '15'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Pegar una punta de vara',
            'cantidad' => '1',
            'id_reparacion' => '16'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Afilar cadena',
            'cantidad' => '1',
            'id_reparacion' => '17'
        ]);

        DB::table('detalles_reparacion')->insert([
            'descripcion' => 'Cubiertas MAXAM 420/70 R28, montadas',
            'cantidad' => '2',
            'id_reparacion' => '18'
        ]);

    }
}
