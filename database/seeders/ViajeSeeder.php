<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viaje;
use App\Models\Ruta;
use App\Models\Destino;
use App\Models\Vehiculo;

class ViajeSeeder extends Seeder
{
    public function run(): void
    {
        $viajes = [
            [
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'placa' => 'ABC123',
                'fecha' => '2026-12-01',
                'hora' => '08:00:00',
                'precio' => 35000
            ],
            [
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'placa' => 'DEF456',
                'fecha' => '2026-12-01',
                'hora' => '14:00:00',
                'precio' => 35000
            ],
            [
                'origen' => 'Cali',
                'destino' => 'Santander de Quilichao',
                'placa' => 'GHI789',
                'fecha' => '2026-12-02',
                'hora' => '09:00:00',
                'precio' => 15000
            ],
            [
                'origen' => 'Popayán',
                'destino' => 'Cali',
                'placa' => 'MNO345',
                'fecha' => '2026-12-02',
                'hora' => '10:00:00',
                'precio' => 35000
            ],
            [
                'origen' => 'Bogotá',
                'destino' => 'Medellín',
                'placa' => 'ABC123',
                'fecha' => '2026-12-03',
                'hora' => '07:00:00',
                'precio' => 95000
            ]
        ];

        foreach ($viajes as $viaje) {

            $origen = Destino::where('ciudad', $viaje['origen'])->firstOrFail();

            $destino = Destino::where('ciudad', $viaje['destino'])->firstOrFail();

            $ruta = Ruta::where('origen_id', $origen->id)
                ->where('destino_id', $destino->id)
                ->firstOrFail();

            $vehiculo = Vehiculo::where('placa', $viaje['placa'])->firstOrFail();

            Viaje::updateOrCreate(
                [
                    'ruta_id' => $ruta->id,
                    'vehiculo_id' => $vehiculo->id,
                    'fecha' => $viaje['fecha'],
                    'hora' => $viaje['hora']
                ],
                [
                    'precio' => $viaje['precio']
                ]
            );
        }
    }
}