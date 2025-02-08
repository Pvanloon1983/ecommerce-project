<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'created_by' => User::factory(), // Create a user if none exists
            'created_by' => '1',
            'title' => $this->faker->sentence(3), // Random title
            'author' => $this->faker->name(), // Fake author name
            'language' => $this->faker->randomElement(['Dutch', 'English', 'Turkish']), // Random language
            'short_description' => $this->faker->text(100), // Short text
            'long_description' => $this->faker->paragraph(5), // Longer text
            'price' => $this->faker->numberBetween(2, 30), // Random price
            'version' => $this->faker->randomElement(['Hardcover NL', 'Hardcover NL-TR']),
            'extra_information' => $this->faker->text(200), // Extra info
            'width' => $this->faker->numberBetween(10, 100), // Random width
            'height' => $this->faker->numberBetween(10, 200), // Random height
            'depth' => $this->faker->numberBetween(5, 50), // Random depth
            'weight' => $this->faker->numberBetween(1, 10), // Random weight
            'picture_one' => $this->faker->imageUrl(400, 400, 'products'), // Random image URL
            'picture_two' => $this->faker->optional()->imageUrl(400, 400, 'products'),
            'picture_three' => $this->faker->optional()->imageUrl(400, 400, 'products'),
            'picture_four' => $this->faker->optional()->imageUrl(400, 400, 'products'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
