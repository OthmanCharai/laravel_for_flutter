<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->name(),
            "image"=>$this->faker->image(),
            "description"=>$this->faker->text(),
            "created_at"=>$this->faker->date(),
            "updated_at"=>$this->faker->date(),
        ];
    }
}
