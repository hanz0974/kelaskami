<?php

namespace App\Livewire;

use App\Models\absens;
use App\Models\matakuliah;
use App\Models\tokenAbsen;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Component;

#[Title('Absen')]
class Absen extends Component
{
    use WithPagination;
    public $kode_mk;
    public $selectedToken = [];

    public $errorMessage;

    public $nim;

    public $inputToken;
    #[Url]
    public $search = '';

    public function submitAbsen()
    {
        $token = tokenAbsen::where('token', $this->inputToken)->first();

        if (! $token) {
            $this->errorMessage = 'Token tidak ditemukan.';

            return;
        }
        // cek validitas waktu
        $now = now();
        $nim = Auth::user()->mahasiswa->nim;

        // cek apakah sudah pernah absen
        $sudahAbsen = Absens::where('nim', $nim)
            ->where('token_absen_id', $token->id)
            ->exists();

        if ($sudahAbsen) {
            session()->flash('gagal', 'Anda sudah melakukan absen untuk pertemuan ini!');
            return $this->redirectRoute('absen', navigate: true);
        } else {

            if ($now->between($token->valid_from, $token->valid_until)) {
                // Token valid → hadir
                absens::create([
                    'nim' => Auth::user()->mahasiswa->nim,
                    'kode_mk' => $token->kode_mk,
                    'token_absen_id' => $token->id,
                    'tanggal' => $now->toDateString(),
                    'status' => 'hadir',
                    'jadwal' => $token->jadwal,
                ]);
                session()->flash('absen', 'Absen Berhasil!');
                // Notify browser to show an alert and notify other Livewire components
                $this->reset(['nim', 'kode_mk']);
                $this->errorMessage = null;

                return $this->redirectRoute('absen', navigate: true);
            } else {
                // Tidak perlu insert alpa di sini, karena sudah otomatis
                session()->flash('gagal', 'Token kadaluarsa!');
                return $this->redirectRoute('absen', navigate: true);
            }
        }

    }

    public function buattoken()
    {
        $this->dispatch('openGenerateToken');
    }

    public function render()
    {
        return view('livewire.absen', [
            'matkul' => matakuliah::search($this->search)->latest()->paginate(10),
        ]);
    }
}
