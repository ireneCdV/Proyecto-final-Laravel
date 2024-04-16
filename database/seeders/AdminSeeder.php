<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'surname' => 'super',
            'phone' => '666555444',
            'address' => 'Calle puerta',
            'dni' => '33221144F',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456789'),
            'cod_admin' => 'F33221144Admin'
        ]);
    }
}
