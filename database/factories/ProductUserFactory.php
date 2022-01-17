<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "created_at"=>$this->faker->date(),
            "updated_at"=>$this->faker->date(),
            "quantity"=>$this->faker->biasedNumberBetween($min = 10, $max = 20, $function = 'sqrt'),
        ];
    }
}
