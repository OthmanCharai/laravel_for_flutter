<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $nbUser=(int)$this->command->ask("type number of users Number");

       // User::factory()->count(30)->create();
       //$roles=Role::factory()->count(15)->create();
       User::factory()->count($nbUser)->create();
    }
}
