<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'name' => $title,
            'synopsis' => $this->faker->paragraphs(3, true),
            'year' => $this->faker->numberBetween(1980, (int)date('Y')),
            'category_id' => 1,
            'cover_image_path' => null,
            'trailer_url' => 'https://www.youtube.com/watch?v=' . $this->faker->bothify('###########'),
        ];
    }
}
