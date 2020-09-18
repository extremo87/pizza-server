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
                'short_description' => 'Tomatoes, mozzarella',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza1.jpg',
                'price' => 18.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'QUATTRO FROMAGGI',
                'short_description' => 'Gorgonzola, ricotta, mozzarella, taleggio',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza2.jpg',
                'price' => 24.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'SALMONE E PESTO DI NOCI',
                'short_description' => 'Salmon, walnut pesto',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza3.jpg',
                'price' => 26.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'POMODORI PANCETTA',
                'short_description' => 'Tomatoes, bacon, onion',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza4.jpg',
                'price' => 22.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'CHEESY GARLIC PIZZA',
                'short_description' => 'Mozzarella, & garlic sauce on a crème fraiche base, ect',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza1.jpg',
                'price' => 28.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'CHEESY GARLIC PIZZA',
                'short_description' => 'Lots of pepperoni & mozzarella',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza2.jpg',
                'price' => 17.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'GRAND SUPREME',
                'short_description' => 'Baby spinach, smoked leg ham, olives, mozzarella, ect',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza3.jpg',
                'price' => 15.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'PACHINO PICCANTE',
                'short_description' => 'Marinated cherry tomatoes',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi suscipit sed justo eu tempus.',
                'image' => 'https://static.nnc.kz/pizza4.jpg',
                'price' => 15.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
