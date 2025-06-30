<?php

namespace Database\Factories;

use App\Models\ApplicationUser;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApplicationUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'client_code' => $this->faker->unique()->regexify('[A-Z]{5}[0-9]{5}'),
            'allow_login' => $this->faker->boolean(),
            'url' => $this->faker->url(),
        ];
    }
}
