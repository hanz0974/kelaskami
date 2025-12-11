<?php

namespace App\Console\Commands;

use App\Models\absens;
use App\Models\TokenAbsen;
use Illuminate\Console\Command;

class UpdateExpiredAbsens extends Command
{
    // Nama command yang dipanggil di scheduler
    protected $signature = 'absen:update-expired';

    protected $description = 'Update status absen menjadi alpa jika token sudah kadaluarsa';

    public function handle()
    {
        // Ambil semua token yang sudah expired
        $expiredTokens = TokenAbsen::where('valid_until', '<', now())->get();

        foreach ($expiredTokens as $token) {
            $mk = $token->matakuliah;
            // Ambil semua mahasiswa yang mengontrak MK ini
            $mahasiswas = $mk->mahasiswa;

            foreach ($mahasiswas as $mhs) {
                $exists = absens::where('nim', $mhs->nim)
                    ->where('token_absen_id', $token->id)
                    ->exists();
                if (! $exists) {
                    absens::create([
                        'nim' => $mhs->nim,
                        'kode_mk' => $token->kode_mk,
                        'token_absen_id' => $token->id,
                        'tanggal' => $token->valid_until->toDateString(),
                        'status' => 'alpa',
                        'jadwal' => $token->jadwal,
                    ]);
                }
            }
        }
        $this->info('Absensi expired berhasil diupdate.');
    }
}
