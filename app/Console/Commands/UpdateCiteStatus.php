<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cita;
use Carbon\Carbon;

class UpdateCiteStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-cite-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar el estado de las citas a pasada';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtener la fecha y hora actual
        $currentDateTime = Carbon::now();

        // Obtener todas las citas abiertas (estado = 1)
        $cites = Cita::where('estado', true)->get();

        foreach ($cites as $cite) {
            // Combinar la fecha y la hora de la cita en un solo objeto Carbon
            $citeDateTime = Carbon::parse("{$cite->fecha} {$cite->hora}");

            // Registro de depuración
            $this->info("Comparando cita con fecha y hora: {$citeDateTime} con la fecha y hora actual: {$currentDateTime}");

            // Comparar la fecha y hora actual con la fecha y hora de la cita
            if ($citeDateTime < $currentDateTime) {
                // Si la cita está en el pasado, actualizar su estado a 'pasada' (estado = 0)
                $cite->estado = false;
                $cite->save();
                $this->info("Cita actualizada a 'pasada': {$cite->id}");
            }
        }

        // Informar sobre la ejecución exitosa del comando
        $this->info('El estado de las citas ha sido actualizado correctamente.');

        // Devolver el código de éxito del comando
        return Command::SUCCESS;
    }
}
