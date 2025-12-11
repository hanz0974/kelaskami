<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\mahasiswa;
use App\Models\matakuliah;
use Illuminate\Support\Facades\Hash;

class KontrakMkSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create 20 mahasiswa (with users)
        $students = User::factory(20)->create([
            'role' => 'mahasiswa',
        ])->each(function ($user) {
            mahasiswa::factory()->create([
                'id' => $user->id,
            ]);
        });

        // Create 10 matakuliah
        $mks = matakuliah::factory()->count(10)->create();

        // Attach random matakuliah to each mahasiswa
        $allMkIds = $mks->pluck('kode_mk')->toArray();

        mahasiswa::all()->each(function ($mahasiswa) use ($allMkIds) {
            // choose random 3-6 matakuliah per mahasiswa
            $count = rand(3, min(6, count($allMkIds)));
            $selected = (array) array_rand(array_flip($allMkIds), $count);
            // attach by kode_mk (pivot uses kode_mk)
            $mahasiswa->matakuliah()->syncWithoutDetaching($selected);
        });
    }
}
