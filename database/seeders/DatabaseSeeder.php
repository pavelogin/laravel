<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory(10)->create();

        $categories = Category::factory(10)->create();

        foreach ($categories as $category) {
            $category->products()->saveMany(
                Product::factory(rand(5,10))->make()
            );
        }
    }
}
