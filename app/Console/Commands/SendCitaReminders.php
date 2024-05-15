<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cita;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaReminder;

class SendCitaReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-cita-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía recordatorios de citas por correo electrónico';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $citas = Cita::where('fecha', '=', now()->format('Y-m-d'))
                     ->where('notificado', false)
                     ->get();

        foreach ($citas as $cita) {
            if (now()->diffInHours($cita->hora, false) <= 24) { // Enviar recordatorio 24 horas antes
                Mail::to($cita->usuario->email)->send(new CitaReminder($cita));
                $cita->notificado = true;
                $cita->save();
                $this->info('Recordatorio enviado a ' . $cita->usuario->email);
            }
        }
    }
}