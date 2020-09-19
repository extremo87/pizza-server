<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'title' => 'MARGHERITA',
                'ingredients' => 'Tomatoes, mozzarella',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza1.jpg',
                'price' => 18.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'QUATTRO FROMAGGI',
                'ingredients' => 'Gorgonzola, ricotta, mozzarella, taleggio',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza2.jpg',
                'price' => 24.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SALMONE E PESTO DI NOCI',
                'ingredients' => 'Salmon, walnut pesto',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza3.jpg',
                'price' => 26.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'POMODORI PANCETTA',
                'ingredients' => 'Tomatoes, bacon, onion',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza4.jpg',
                'price' => 22.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'CHEESY GARLIC PIZZA',
                'ingredients' => 'Mozzarella, & garlic sauce on a crème fraiche base, ect',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza1.jpg',
                'price' => 28.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'CHEESY GARLIC PIZZA',
                'ingredients' => 'Lots of pepperoni & mozzarella',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza2.jpg',
                'price' => 17.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'GRAND SUPREME',
                'ingredients' => 'Baby spinach, smoked leg ham, olives, mozzarella, ect',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza3.jpg',
                'price' => 15.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'PACHINO PICCANTE',
                'ingredients' => 'Marinated cherry tomatoes',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza4.jpg',
                'price' => 15.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
