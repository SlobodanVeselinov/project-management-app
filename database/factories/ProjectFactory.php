<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->words(3, true),
            'description'   => $this->faker->paragraphs(6, true),
            'start_date'    => $this->faker->date('d/m/Y'),
            'end_date'      => $this->faker->date('d/m/Y')
        ];
    }
}
