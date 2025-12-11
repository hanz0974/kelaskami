<?php

namespace Database\Seeders;

use App\Models\dosen;
use App\Models\User;
use App\Models\mahasiswa;
use App\Models\matakuliah;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create([
            'role' => 'Mahasiswa',
        ])->each(function ($user) {
            mahasiswa::factory()->create([
                'id' => $user->id,
                'nama' => $user->name,
            ]);
        });
        User::factory(10)->create([
            'role' => 'dosen',
        ])->each(function ($user) {
            dosen::factory()->create([
                'id' => $user->id,
                'nama' => $user->name,
            ]);
        });
        $dosenUser = User::updateOrCreate(
            ['email' => 'dosenmuda@gmail.com'],
            [
                'name' => 'Dosen Muda',
                'role' => 'dosen',
                'password' => Hash::make('dosen123'),
            ]
        );
        Dosen::updateOrCreate(
            ['id' => $dosenUser->id],
            [
                'nip' => 'NIP00001',
                'nama' => 'Dosen Muda',
                'foto' => null,
            ]
        );
        // Add custom mahasiswa user and related mahasiswa data
        $mahasiswaUser = User::updateOrCreate(
            ['email' => 'farhananayi@gmail.com'],
            [
                'name' => 'Farhan Hanai',
                'role' => 'mahasiswa',
                'password' => Hash::make('farhan09'),
            ]
        );
        Mahasiswa::updateOrCreate(
            ['id' => $mahasiswaUser->id],
            [
                'nim' => 'NIM00001',
                'nama' => 'Farhan Hanai',
                'foto' => null,
                'angkatan' => 2022,
                'prodi' => 'S1-Teknik Elektro',
                'jenis_kelamin' => 'Laki-laki',
            ]
        );

        // Call kontrak seeder to generate mahasiswa/matakuliah relations
        $this->call(\Database\Seeders\KontrakMkSeeder::class);
    }
}
