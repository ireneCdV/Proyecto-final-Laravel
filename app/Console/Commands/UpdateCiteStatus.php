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
    protected $description = 'Actualizar el estado de las citas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
             // Obtener la fecha y hora actual
             $currentDateTime = Carbon::now();

             // Obtener todas las citas abiertas
             $cites = Cita::where('estado', 'abierta')->get();
     
             foreach ($cites as $cite) {
                 // Comparar la fecha y hora actual con la fecha y hora de la cita
                 if ($cite->date_time < $currentDateTime) {
                     // Si la cita está en el pasado, actualizar su estado a 'pasada'
                     $cite->estado = 'pasada';
                     $cite->save();
                 }
             }
     
             // Informar sobre la ejecución exitosa del comando
             $this->info('El estado de las citas ha sido actualizado correctamente.');
         }
}
