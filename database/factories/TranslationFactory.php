<?php

namespace Database\Factories;

use App\Models\Locale;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->slug,
            'value' => $this->faker->sentence,
            'locale_id' => Locale::inRandomOrder()->first()->id,
        ];
    }
}
