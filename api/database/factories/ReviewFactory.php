<?php

namespace Database\Factories;

use App\Models\ContentType;
use App\Models\Franchise;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hours = $this->faker->numberBetween(0, 2); // Genera un número aleatorio entre 0 y 23 para las horas
        $minutes = $this->faker->numberBetween(0, 59); // Genera un número aleatorio entre 0 y 59 para los minutos
        $seconds = $this->faker->numberBetween(0, 59); // Genera un número aleatorio entre 0 y 59 para los segundos
        $contentType = ContentType::inRandomOrder()->first();

        $durationTime = $contentType->id !== 1 ? sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) : null;
        $quantityEpisode = $contentType->id === 1 ? $this->faker->randomNumber() : null;
        return [
            'franchise_id' => Franchise::inRandomOrder()->first()->franchise_id,
            'content_type_id' => $contentType,
            'user_id' => User::inRandomOrder()->first()->id,
            'title_alternative' => $this->faker->sentence,
            'description_alternative' => $this->faker->paragraph,
            'data' => $this->faker->sentence,
            'rating_main' => $this->faker->randomFloat(2, 1, 10),
            'spoiler_content' => $this->faker->boolean,
            'release_year' => $this->faker->date,
            'release_year_end' => $this->faker->date,
            'quantity_episode' => $quantityEpisode,
            'duration_time' => $durationTime,
            'published' => $this->faker->boolean,
            'notify' => $this->faker->boolean,
        ];
    }
}
