<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Flowers\Models\Flower;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlowerFactory extends Factory
{
    protected $model = Flower::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(rand(1, 3)),
            'watering_time' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'watering_interval' => $this->faker->numberBetween(1, 10),
            'room_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
