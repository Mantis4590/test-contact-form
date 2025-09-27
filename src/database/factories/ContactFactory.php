<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory {
    public function definition(): array {
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('0##########'),// 10~11桁
            'address' => $this->faker->address,
            'building' => $this->faker->optional()->secondaryAddress,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->realText(50),
        ];
    }
}