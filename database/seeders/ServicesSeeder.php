<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Corte + Peinar',
            'price' => 11,
        ]);

        Service::create([
            'name' => 'Corte + Barba',
            'price' => 10,
        ]);

        Service::create([
            'name' => 'Lavar + Cortar + Peinar',
            'price' => 15,
        ]);

        Service::create([
            'name' => 'Tratamiento Hidratado',
            'price' => 7,
        ]);

        Service::create([
            'name' => 'Tinte',
            'price' => 11,
        ]);

        Service::create([
            'name' => 'Tinte + Mechas',
            'price' => 20,
        ]);

        Service::create([
            'name' => 'Trenzas',
            'price' => 15,
        ]);

        Service::create([
            'name' => 'Corte + Diseño',
            'price' => 10,
        ]);

        Service::create([
            'name' => 'Reflejos',
            'price' => 5,
        ]);

        Service::create([
            'name' => 'Recogidos',
            'price' => 9,
        ]);
    }
}
