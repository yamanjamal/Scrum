<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SrsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'link'=>$this->faker->url(),
            'project_id'=>rand(1,10),
        ];
    }
}
