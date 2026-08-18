<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        // Create 10 Categories
        for ($i = 1; $i <= 10; $i++) {

            $name = fake()->unique()->word();

            $categories[] = Category::create([
                'name'   => ucfirst($name),
                'slug'   => Str::slug($name),
                'cover'  => null,
                'status' => true,
            ]);
        }

        // Create 100 Products
        for ($i = 1; $i <= 100; $i++) {

            $name = fake()->unique()->words(3, true);

            Product::create([
                'name'        => ucfirst($name),
                'slug'        => Str::slug($name) . "-{$i}",
                'description' => fake()->paragraph(),
                'status'      => fake()->boolean(),
                'price'       => fake()->randomFloat(2, 50, 5000),
                'category_id' => fake()->randomElement($categories)->id,
            ]);
        }
    }
}
