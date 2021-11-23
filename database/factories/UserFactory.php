<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'id_role'=>$this->faker->regexify('[1234]{1}'),
            'birthdate'=>$this->faker->date(),
            'email_verified_at' => now(),
            'status'=>$this->faker->randomElements(['Activo', 'Despedido','Retirado'])[0],
            'gender'=>$this->faker->regexify('[01]{1}'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
