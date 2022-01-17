<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nbProduct=(int)$this->command->ask("type Image Number");
        $user=Product::all();
        Image::factory()->count($nbProduct)->make()->each(function ($image) use($user) {
                $image->product_id=$user->random()->id;
                $image->save();
        });
    }
}
