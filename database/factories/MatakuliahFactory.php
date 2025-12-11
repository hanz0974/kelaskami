<?php

namespace Database\Factories;

use App\Models\matakuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatakuliahFactory extends Factory
{
    protected $model = matakuliah::class;

    public function definition()
    {
        // kode_mk format MKXXX (three digits)
        $kode = 'MK' . $this->faker->unique()->numberBetween(100, 999);

        $courseNames = [
            'Pemrograman Web',
            'Jaringan Komputer',
            'Basis Data',
            'Sistem Operasi',
            'Algoritma dan Struktur Data',
            'Rekayasa Perangkat Lunak',
            'Keamanan Komputer',
            'Kecerdasan Buatan',
            'Pemrograman Mobile',
            'Interaksi Manusia dan Komputer',
            'Sistem Informasi',
            'Grafika Komputer',
            'Pemrograman Berorientasi Objek'
        ];

        return [
            'kode_mk' => $kode,
            'nama' => $this->faker->randomElement($courseNames),
            // use a placeholder image URL (not stored locally here)
            'foto' => 'https://picsum.photos/seed/' . $kode . '/300/200',
            'kelas' => $this->faker->randomElement(['A','B','C']),
            'sks' => $this->faker->numberBetween(2,4),
            'semester' => $this->faker->numberBetween(1,8),
        ];
    }
}
