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
            "quantity"=>$this->faker->biasedNumberBetween($min = 10, $max = 20, $function = 'sqrt'),
            "price"=>$this->faker->rand(10,100),
        ];
    }
}
