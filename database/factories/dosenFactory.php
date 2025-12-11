<?php

namespace Database\Factories;

use App\Models\dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\dosen>
 */
class dosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = dosen::class;
    public function definition(): array
    {
        return [
            'id' => null,
            'nip' => $this->faker->unique()->numerify('########'),
            'nama' => $this->faker->name(),
            'foto' => null,
        ];
    }
}
