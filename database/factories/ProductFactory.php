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
            'name' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'stock'=>random_int(5,10000),
            'cost'=>$this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
