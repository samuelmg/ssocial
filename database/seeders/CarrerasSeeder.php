<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carreras')->insert(['clave' => 'INNI', 'carrera' => 'INGENIERIA INFORMATICA',]);
        DB::table('carreras')->insert(['clave' => 'ICOM', 'carrera' => 'INGENIERIA EN COMPUTACION',]);
        Carrera::create(['clave' => 'CEL', 'carrera' => 'LICENCIATURA EN INGENIERIA EN COMUNICACIONES Y ELECTRONICA']);
    }
}
