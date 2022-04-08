<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(10),
            'description'=>$this->faker->text(300),
            'dead_line'=>$this->faker->date(),
            'teamleader_id'=>rand(1,10),
        ];
    }
}
