<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            "description"=>$this->faker->text(),
            "created_at"=>$this->faker->date(),
            "updated_at"=>$this->faker->date(),
            "quantity"=>$this->faker->biasedNumberBetween($min = 10, $max = 20, $function = 'sqrt'),
            "status"=>$this->faker->text(),
            "isPopulaire"=>$this->faker->boolean(),
            "price"=>$this->faker->biasedNumberBetween($min = 10, $max = 20, $function = 'sqrt')
        ];
    }
}
