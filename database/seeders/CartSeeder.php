<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users=User::all();
        Product::all()->each(function ($product) use ($users) {
            $product->carts()->attach(
            $users->random(rand(1, 3))->pluck('id')->toArray(),
            );
        });
    }
}
