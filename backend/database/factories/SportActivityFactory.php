<?php

namespace Database\Factories;

use App\Models\SportActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(255),
            'date' => $this->faker->date(),
            'start_hour' => $this->faker->time(),
            'end_hour' => $this->faker->time(),
            'recurrence' => $this->faker->numberBetween(0, 100),
        ];
    }
}
