<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => 'Peine',
        ]);

        Category::create([
            'title' => 'Champu',

        ]);

        Category::create([
            'title' => 'Crema',


        ]);

        Category::create([
            'title' => 'Mascarilla',

        ]);

        Category::create([
            'title' => 'Serum',

        ]);

        Category::create([
            'title' => 'Aceite',

        ]);

        Category::create([
            'title' => 'Tonico',

        ]);

        Category::create([
            'title' => 'Protector',

        ]);

        Category::create([
            'title' => 'Gel',

        ]);

        Category::create([
            'title' => 'Acondicionador',

        ]);
    }
}
