<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=Role::all();
        Role::all()->each(function ($role) use ($users) {
            $role->users()->attach(
                $users->random(rand(1, $users->count()))->pluck('id')->toArray()
            );
        });


    }
}
