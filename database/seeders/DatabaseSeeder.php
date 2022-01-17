<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        if($this->command->confirm("do you want to rollback migrations ?",true)){
            $this->command->call("migrate:rollback");
            $this->command->info("waiting !!");
            $this->command->call("migrate");
            $this->command->info("dataBase was refreshed !!");
        }
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class,
            CategoryProductSeeder::class,
            BannerSeeder::class,
            ImageSeeder::class
        ]);
    }
}
