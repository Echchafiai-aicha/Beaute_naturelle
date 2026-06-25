<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $soins   = Category::create(['name' => 'Soins visage']);
        $cheveux = Category::create(['name' => 'Soins cheveux']);
        $corps   = Category::create(['name' => 'Soins corps']);
        $parfums = Category::create(['name' => 'Parfums naturels']);

        $products = [
            [
                'category_id' => $soins->id,
                'name'        => "Huile d'argan pure",
                'description' => "Huile d'argan 100% naturelle, pressée à froid. Riche en vitamine E.",
                'price'       => 89.90,
                'stock'       => 50,
                'image'       => null,
            ],
            [
                'category_id' => $soins->id,
                'name'        => "Crème hydratante à l'eau de rose",
                'description' => "Crème légère formulée à l'eau de rose. Hydrate et apaise la peau.",
                'price'       => 65.00,
                'stock'       => 30,
                'image'       => null,
            ],
            [
                'category_id' => $soins->id,
                'name'        => "Masque visage à l'argile blanche",
                'description' => "Masque purifiant à l'argile blanche kaolin. Resserre les pores.",
                'price'       => 45.00,
                'stock'       => 40,
                'image'       => null,
            ],
            [
                'category_id' => $corps->id,
                'name'        => "Savon naturel au lait de chèvre",
                'description' => "Savon artisanal au lait de chèvre et beurre de karité.",
                'price'       => 25.00,
                'stock'       => 100,
                'image'       => null,
            ],
            [
                'category_id' => $corps->id,
                'name'        => "Beurre corporel au karité pur",
                'description' => "Beurre de karité non raffiné. Idéal pour les peaux très sèches.",
                'price'       => 79.00,
                'stock'       => 25,
                'image'       => null,
            ],
            [
                'category_id' => $cheveux->id,
                'name'        => "Shampooing solide au rhassoul",
                'description' => "Shampooing à l'argile rhassoul. Sans sulfates ni silicones.",
                'price'       => 55.00,
                'stock'       => 60,
                'image'       => null,
            ],
            [
                'category_id' => $cheveux->id,
                'name'        => "Masque capillaire à l'huile d'avocat",
                'description' => "Masque nourrissant à l'huile d'avocat et protéines de soie.",
                'price'       => 70.00,
                'stock'       => 35,
                'image'       => null,
            ],
            [
                'category_id' => $parfums->id,
                'name'        => "Eau de parfum Jasmin & Cèdre",
                'description' => "Fragrance naturelle au jasmin du Maroc et cèdre de l'Atlas.",
                'price'       => 120.00,
                'stock'       => 20,
                'image'       => null,
            ],
        ];

        foreach ($products as $data) {
            $data['slug'] = Str::slug($data['name']);
            Product::create($data);
        }
    }
}