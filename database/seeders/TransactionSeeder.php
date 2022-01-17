<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
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
        
        User::all()->each(function ($user) use ($products) {
            $user->shopping()->attach(
                $products->random(rand(1, 5))->pluck('id')->toArray()
            );
        });


    }
}
