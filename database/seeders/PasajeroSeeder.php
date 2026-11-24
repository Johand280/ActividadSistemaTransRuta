<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasajero;

class PasajeroSeeder extends Seeder
{
    public function run(): void
    {
        $pasajeros = [
            [
                'nombre' => 'Carlos Andrés Pérez',
                'identificacion' => '1001234567',
                'telefono' => '3101234567',
                'correo' => 'carlos@gmail.com'
            ],
            [
                'nombre' => 'María Fernanda López',
                'identificacion' => '1002345678',
                'telefono' => '3112345678',
                'correo' => 'maria@gmail.com'
            ],
            [
                'nombre' => 'Juan David Rodríguez',
                'identificacion' => '1003456789',
                'telefono' => '3123456789',
                'correo' => 'juan@gmail.com'
            ],
            [
                'nombre' => 'Laura Marcela Gómez',
                'identificacion' => '1004567890',
                'telefono' => '3134567890',
                'correo' => 'laura@gmail.com'
            ],
            [
                'nombre' => 'Andrés Felipe Martínez',
                'identificacion' => '1005678901',
                'telefono' => '3145678901',
                'correo' => 'andres@gmail.com'
            ]
        ];

        foreach ($pasajeros as $pasajero) {
            Pasajero::updateOrCreate(
                ['identificacion' => $pasajero['identificacion']],
                $pasajero
            );
        }
    }
}