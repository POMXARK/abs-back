<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Ab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Ab>
 */
final class AbFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Ab::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'description' => fake()->text,
            'price' => fake()->randomFloat(2, 0, 999999),
        ];
    }
}
