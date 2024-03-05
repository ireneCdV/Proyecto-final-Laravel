<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'image' => 'imagenes/champutimotei.jpg',
            'name' => 'Champú',
            'description' => 'Champú específico para el pelo rizado.',
            'price' => 8.50,
            'stock' => 10,
            'brand' => 'Timotei',
        ]);

        Product::create([
            'image' => 'imagenes/cremaelvive.jpg',
            'name' => 'Crema',
            'description' => 'Crema de peinado, específica para el pelo liso.',
            'price' => 5.99,
            'stock' => 12,
            'brand' => 'Elvive',
        ]);

        Product::create([
            'image' => 'imagenes/mascarillaelvive.jpg',
            'name' => 'Mascarilla',
            'description' => 'Mascarilla 72 horas de hidratación.',
            'price' => 4.25,
            'stock' => 7,
            'brand' => 'Elvive',
        ]);

        Product::create([
            'image' => 'imagenes/peinedenman.jpg',
            'name' => 'Peine',
            'description' => 'Peine especial para definir rizos.',
            'price' => 16.50,
            'stock' => 5,
            'brand' => 'Denman',
        ]);

        Product::create([
            'image' => 'imagenes/serumpantene.jpg',
            'name' => 'Sérum',
            'description' => 'Repara y protege el pelo.',
            'price' => 6,
            'stock' => 8,
            'brand' => 'Pantene',
        ]);

        Product::create([
            'image' => 'imagenes/serumkerastase.jpg',
            'name' => 'Sérum',
            'description' => 'K Génesis Sérum Fortificante Anticaída.',
            'price' => 32.50,
            'stock' => 3,
            'brand' => 'Kerastase',
        ]);

        Product::create([
            'image' => 'imagenes/champubatiste.jpg',
            'name' => 'Champú',
            'description' => 'Champú en Seco Original.',
            'price' => 1.50,
            'stock' => 20,
            'brand' => 'Batiste',
        ]);

        Product::create([
            'image' => 'imagenes/champubabaria.jpg',
            'name' => 'Champú',
            'description' => 'Champú de Cebolla.',
            'price' => 2.99,
            'stock' => 15,
            'brand' => 'Babaria',
        ]);

        Product::create([
            'image' => 'imagenes/aceiteolaplex.jpg',
            'name' => 'Aceite',
            'description' => 'Aceite Capilar Reparador N7 Bonding Oil.',
            'price' => 20,
            'stock' => 7,
            'brand' => 'Olaplex',
        ]);

        Product::create([
            'image' => 'imagenes/gelfijadoreco.jpg',
            'name' => 'Gel Fijador ',
            'description' => 'Gel Fijador con Aceite de Coco.',
            'price' => 16.50,
            'stock' => 5,
            'brand' => 'Eco Styler',
        ]);

        Product::create([
            'image' => 'imagenes/cremapantene.jpg',
            'name' => 'Crema',
            'description' => 'Curly Crema de Peinado para Rizos.',
            'price' => 12.99,
            'stock' => 8,
            'brand' => 'Pantene',
        ]);

        Product::create([
            'image' => 'imagenes/champugarnier.jpg',
            'name' => 'Champú',
            'description' => 'Original Remedies Carbón Magnético Champú Equilibrante.',
            'price' => 3,
            'stock' => 10,
            'brand' => 'Garnier',
        ]);

        Product::create([
            'image' => 'imagenes/acondicionadorpantene.jpg',
            'name' => 'Acondicionador',
            'description' => 'Acondicionador repara y protege 3 minute.',
            'price' => 3.50,
            'stock' => 14,
            'brand' => 'Pantene',
        ]);

        Product::create([
            'image' => 'imagenes/spraybabaria.jpg',
            'name' => 'Protector Solar',
            'description' => 'Spray Protector Solar Pieles Sensibles.',
            'price' => 9.99,
            'stock' => 22,
            'brand' => 'Babaria',
        ]);

        Product::create([
            'image' => 'imagenes/tonicocrusellas.jpg',
            'name' => 'Tonico',
            'description' => 'Tónico Capilar Ronquina Extra Superior Romero.',
            'price' => 9.99,
            'stock' => 10,
            'brand' => 'Crusellas',
        ]);

        Product::create([
            'image' => 'imagenes/mascarillagarnier.jpg',
            'name' => 'Mascarilla ',
            'description' => 'Fructis Hair Food Mascarilla Cabello 3 en 1 Banana.',
            'price' => 6.50,
            'stock' => 15,
            'brand' => 'Garnier',
        ]);

        Product::create([
            'image' => 'imagenes/gelrevlon.jpg',
            'name' => 'Gel Activador',
            'description' => 'Pro You The Twister Scrunch Gel Activador Rizos.',
            'price' => 25,
            'stock' => 8,
            'brand' => 'Revlon',
        ]);

        Product::create([
            'image' => 'imagenes/lacanelly.jpg',
            'name' => 'Laca',
            'description' => 'Laca Normal.',
            'price' => 1,
            'stock' => 30,
            'brand' => 'Nelly',
        ]);

        Product::create([
            'image' => 'imagenes/fortalecedorpantene.jpg',
            'name' => 'Fortalecedor',
            'description' => 'Fortalecedor de Raíces.',
            'price' => 5.99,
            'stock' => 10,
            'brand' => 'Pantene',
        ]);

        Product::create([
            'image' => 'imagenes/cepillobeter.jpg',
            'name' => 'Cepillo',
            'description' => 'Cepillo Desenredante Natural Fiber Detangling Mini.',
            'price' => 5,
            'stock' => 10,
            'brand' => 'Beter',
        ]);
    }
}
