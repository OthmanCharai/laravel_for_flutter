<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products=Product::all();
        Category::all()->each(function ($category) use ($products) {
            $category->products()->attach(
            $products->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}
