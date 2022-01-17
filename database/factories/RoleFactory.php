<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //role
            "role"=>$this->faker->name(),
            "created_at"=>$this->faker->date(),
            "updated_at"=>$this->faker->date(),
        ];
    }
}
