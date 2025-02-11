<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Bilal',
            'last_name' => 'van Loon',
            'email' => 'bilalvanloon@gmail.com',
            'role' => 'admin',
            'password' => '12345678'
        ]);
        Category::factory(10)->create();
        Product::factory(10)->create();

        $products = Product::all();
        $categories = Category::all();

        foreach ($products as $product) {
            // Get random categories
            $randomCategories = $categories->random(rand(1, 3));
    
            // Attach random categories to the product
            foreach ($randomCategories as $category) {
                $product->categories()->attach($category->id);
            }
        }
    }
}
