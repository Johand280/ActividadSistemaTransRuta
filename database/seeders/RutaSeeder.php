<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruta;
use App\Models\Destino;

class RutaSeeder extends Seeder
{
    public function run(): void
    {
        $rutas = [
            [
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'distancia' => 140
            ],
            [
                'origen' => 'Cali',
                'destino' => 'Santander de Quilichao',
                'distancia' => 45
            ],
            [
                'origen' => 'Popayán',
                'destino' => 'Cali',
                'distancia' => 140
            ],
            [
                'origen' => 'Santander de Quilichao',
                'destino' => 'Bogotá',
                'distancia' => 550
            ],
            [
                'origen' => 'Bogotá',
                'destino' => 'Medellín',
                'distancia' => 415
            ]
        ];

        foreach ($rutas as $ruta) {

            $origen = Destino::where('ciudad', $ruta['origen'])->firstOrFail();

            $destino = Destino::where('ciudad', $ruta['destino'])->firstOrFail();

            Ruta::updateOrCreate(
                [
                    'origen_id' => $origen->id,
                    'destino_id' => $destino->id
                ],
                [
                    'distancia' => $ruta['distancia']
                ]
            );
        }
    }
}