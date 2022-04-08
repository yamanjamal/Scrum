<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RequirmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description'=>$this->faker->text(300),
            'project_id'=>rand(1,10),
        ];
    }
}
