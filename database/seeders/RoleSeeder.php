<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $role1=(string)$this->command->ask("type a role ");
        $role2=(string)$this->command->ask("type a role ");
        $role3=(string)$this->command->ask("type a role ");

        Role::factory()->count(3)->state(new Sequence(
            ['role'=>$role1],
            ['role'=>$role2],
            ['role'=>$role3],
        ))->create();

    }
}
