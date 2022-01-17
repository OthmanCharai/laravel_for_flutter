<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nbCategory=(int)$this->command->ask("type Cantegory Number");
        Category::factory()->count($nbCategory)->create();
    }
}
