<?php

namespace Database\Factories;

use App\Models\Franchise;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Franchise>
 */
class FranchiseFactory extends Factory
{
    protected $model = Franchise::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
    return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'animation_studio_latest' => $this->faker->company,
            'image_url' => $this->faker->imageUrl,
            'author' => $this->faker->name,
            'original_work' => $this->faker->sentence,
            'first_release' => $this->faker->date,
            'end_release' => $this->faker->date,
        ];
    }
}
