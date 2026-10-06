<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('usuarios')->insert([
            'nombre' => 'Juan Pablo Peñuela',
            'direccion' => 'C/ Carmen 14',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'jppenuela@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'jpadm',
            'password' => Hash::make('adm1234'),
            'telefono' => '647129933',
            'rol' => 'administrador'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Antonio García',
            'direccion' => 'C/ San Antonio 4',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'agarcia@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'agarcia',
            'password' => Hash::make('ag1234'),
            'telefono' => '600123123',
            'rol' => 'jefe_taller'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Mamen García',
            'direccion' => 'C/ Molino Don Pedro Mateo 10',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'mamengarcia@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'mamen',
            'password' => Hash::make('mg1234'),
            'telefono' => '600234234',
            'rol' => 'administrativo'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Ildefonso González Ortiz',
            'direccion' => 'C/ San Pedro 3',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'igonzalez@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'igonzalez',
            'password' => Hash::make('ig1234'),
            'telefono' => '611222333',
            'rol' => 'mecanico'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Juan Carlos García Díaz',
            'direccion' => 'C/ Pintor Antonio Bujalance 22',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'jcgarcia@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'jcgarcia',
            'password' => Hash::make('jc1234'),
            'telefono' => '600147147',
            'rol' => 'mecanico'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Antonio García Ramírez',
            'direccion' => 'C/ Trascastillo 2',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'nonogarcia@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'nono',
            'password' => Hash::make('ng1234'),
            'telefono' => '600111222',
            'rol' => 'mecanico'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Francisca Cámara Rojas',
            'direccion' => 'C/ Carmen 14',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'fcamara@gamil.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'fcamara',
            'password' => Hash::make('fc1234'),
            'telefono' => '677080161',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Pedro José Peñuela Cámara',
            'direccion' => 'C/ Carmen 14',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'pedropenuela@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'pjpenuela',
            'password' => Hash::make('pj1234'),
            'telefono' => '601002003',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Belén Vacas Buenosvinos',
            'direccion' => 'C/ Molino Don Pedro Mateo 12',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'bvacas@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'belenvb',
            'password' => Hash::make('bv1234'),
            'telefono' => '601012034',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Francisco Vacas',
            'direccion' => 'C/ Molino Don Pedro Mateo 12',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'fvacas@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'fvacas',
            'password' => Hash::make('fv1234'),
            'telefono' => '600123456',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Antonio Alcudia',
            'direccion' => 'C/ Federico García Lorca 12',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'aalcudia@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'aalcudia',
            'password' => Hash::make('aa1234'),
            'telefono' => '601112233',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Juan Arroyo',
            'direccion' => 'C/ Poeta Mario López 19',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'jarroyo@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'jarroyo',
            'password' => Hash::make('ja1234'),
            'telefono' => '601045085',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'María Cantarero',
            'direccion' => 'C/ Mateo Pérez 11',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'mcantarero@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'mcantarero',
            'password' => Hash::make('mc1234'),
            'telefono' => '600852741',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Rafa Jurado',
            'direccion' => 'Av./ Doctor Fleming 3',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'rjurado@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'rjurado',
            'password' => Hash::make('rj1234'),
            'telefono' => '612951753',
            'rol' => 'cliente'
        ]);

        DB::table('usuarios')->insert([
            'nombre' => 'Juani Marín',
            'direccion' => 'C/ Jurada 12',
            'ciudad' => 'Bujalance, Córdoba',
            'email' => 'jmarin@gmail.com',
            'email_verified_at' => '2024-11-22',
            'usuario' => 'jmarin',
            'password' => Hash::make('jm1234'),
            'telefono' => '612987654',
            'rol' => 'cliente'
        ]);

    }
}
