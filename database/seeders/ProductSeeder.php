<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nbProduct=(int)$this->command->ask("type Product Number");
        $user=User::all();
        Product::factory()->count($nbProduct)->make()->each(function ($product) use($user) {
                $product->user_id=$user->random()->id;
                $product->save();
        });
    }
}
