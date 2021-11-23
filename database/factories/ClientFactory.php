<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName()." ".$this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->address(),
            'gender'=>$this->faker->regexify('[01]{1}'),
        ];
    }
}
