<?php

namespace Database\Factories;

use App\Models\LongUrl;
use App\Services\RandomStringGeneratorService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortUrl>
 */
class ShortUrlFactory extends Factory
{
    public function __construct(
        protected RandomStringGeneratorService $randomStringGeneratorService
    ) {}

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->randomStringGeneratorService->generate(),
            'clicks' => fake()->numberBetween(1, 4),
            'long_url_id' => LongUrl::factory()
        ];
    }
}
