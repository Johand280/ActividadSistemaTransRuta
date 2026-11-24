<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Pasajero;
use App\Models\Viaje;
use App\Models\Destino;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            [
                'identificacion' => '1001234567',
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'fecha' => '2026-12-01',
                'hora' => '08:00:00',
                'asiento' => 1,
                'estado' => 'pagado'
            ],
            [
                'identificacion' => '1002345678',
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'fecha' => '2026-12-01',
                'hora' => '08:00:00',
                'asiento' => 2,
                'estado' => 'pendiente'
            ],
            [
                'identificacion' => '1003456789',
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'fecha' => '2026-12-01',
                'hora' => '08:00:00',
                'asiento' => 3,
                'estado' => 'cancelado'
            ],
            [
                'identificacion' => '1004567890',
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'fecha' => '2026-12-01',
                'hora' => '14:00:00',
                'asiento' => 1,
                'estado' => 'pagado'
            ],
            [
                'identificacion' => '1005678901',
                'origen' => 'Cali',
                'destino' => 'Popayán',
                'fecha' => '2026-12-01',
                'hora' => '14:00:00',
                'asiento' => 2,
                'estado' => 'pendiente'
            ],
            [
                'identificacion' => '1001234567',
                'origen' => 'Cali',
                'destino' => 'Santander de Quilichao',
                'fecha' => '2026-12-02',
                'hora' => '09:00:00',
                'asiento' => 1,
                'estado' => 'pagado'
            ],
            [
                'identificacion' => '1002345678',
                'origen' => 'Cali',
                'destino' => 'Santander de Quilichao',
                'fecha' => '2026-12-02',
                'hora' => '09:00:00',
                'asiento' => 2,
                'estado' => 'cancelado'
            ],
            [
                'identificacion' => '1003456789',
                'origen' => 'Popayán',
                'destino' => 'Cali',
                'fecha' => '2026-12-02',
                'hora' => '10:00:00',
                'asiento' => 1,
                'estado' => 'pagado'
            ],
            [
                'identificacion' => '1004567890',
                'origen' => 'Bogotá',
                'destino' => 'Medellín',
                'fecha' => '2026-12-03',
                'hora' => '07:00:00',
                'asiento' => 1,
                'estado' => 'pendiente'
            ],
            [
                'identificacion' => '1005678901',
                'origen' => 'Bogotá',
                'destino' => 'Medellín',
                'fecha' => '2026-12-03',
                'hora' => '07:00:00',
                'asiento' => 2,
                'estado' => 'pagado'
            ]
        ];

        foreach ($tickets as $dato) {

            $pasajero = Pasajero::where(
                'identificacion',
                $dato['identificacion']
            )->firstOrFail();

            $origen = Destino::where(
                'ciudad',
                $dato['origen']
            )->firstOrFail();

            $destino = Destino::where(
                'ciudad',
                $dato['destino']
            )->firstOrFail();

            $viaje = Viaje::whereDate('fecha', $dato['fecha'])
                ->where('hora', $dato['hora'])
                ->whereHas('ruta', function ($consulta) use ($origen, $destino) {
                    $consulta->where('origen_id', $origen->id)
                        ->where('destino_id', $destino->id);
                })
                ->firstOrFail();

            Ticket::updateOrCreate(
                [
                    'viaje_id' => $viaje->id,
                    'numero_asiento' => $dato['asiento']
                ],
                [
                    'pasajero_id' => $pasajero->id,
                    'estado' => $dato['estado']
                ]
            );
        }
    }
}