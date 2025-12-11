<?php

namespace Database\Factories;

use App\Models\mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\mahasiswa>
 */
class mahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = mahasiswa::class;
    public function definition(): array
    {
        return [
            'id' => null,
            'nim' => $this->faker->unique()->numerify('########'),
            'nama' => $this->faker->name(),
            'foto' => null,
            'angkatan' => $this->faker->numberBetween(2019, 2025),
            'prodi' => $this->faker->randomElement(['S1-Teknik Elektro', 'S1-Teknik Komputer']),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
        ];
    }
}
