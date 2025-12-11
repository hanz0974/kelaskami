<?php

namespace App\Livewire;

use App\Models\absens;
use App\Models\Matakuliah;
use App\Models\tokenAbsen;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalAbsen extends Component
{
    public $kode_mk;

    public $jadwal;

    public $token;

    public $valid_until; // tambahan

    public function buatToken()
    {
        $this->token = Str::random(8);
    }

    // Open modal to create new record
    #[On('openGenerateToken')]
    public function openCreate()
    {
        $this->reset(['kode_mk', 'jadwal', 'token', 'valid_until']);
        $this->dispatch('open-generate-token');
    }

    public function save()
    {
        $rules = [
            'kode_mk' => 'required',
            'jadwal' => 'required|string|max:16',
            'token' => 'required|string|min:6|max:12',
            'valid_until' => 'required|date|after:valid_from',
        ];
        $validatedData = $this->validate($rules);
        tokenAbsen::create([
            'kode_mk' => $validatedData['kode_mk'],
            'jadwal' => $validatedData['jadwal'],
            'token' => $validatedData['token'],
            'valid_from' => now(), // langsung isi di sini
            'valid_until' => $validatedData['valid_until'],
        ]);

        session()->flash('message', 'Token berhasil dibuat!');
        $this->dispatch('sukses');
        $this->reset(['kode_mk', 'jadwal', 'token', 'valid_until']);
        $this->mode = 'create';
        $this->dispatch('close-modal-token');

        return $this->redirectRoute('absen', navigate: true);
    }

    public function updatedKodeMk($value)
    {
        $lastJadwal = tokenAbsen::where('kode_mk', $value)->max('jadwal');

        if ($lastJadwal) {
            // Ekstrak angka dari string "Pertemuan X"
            preg_match('/\d+$/', $lastJadwal, $matches);
            $next = isset($matches[0]) ? ((int) $matches[0] + 1) : 1;

            // Batasi maksimal 16
            $this->jadwal = $next <= 16 ? "Pertemuan {$next}" : 'Pertemuan 16';
        } else {
            $this->jadwal = 'Pertemuan 1';
        }
    }

    public function closeModaltoken()
    {
        $this->reset(['kode_mk', 'jadwal', 'token', 'valid_until']);
        $this->dispatch('close-modal-token');
    }

    public function render()
    {
        return view('livewire.modal-absen', [
            'matakuliah' => matakuliah::all(),
            'absens' => absens::all(),
        ]);
    }
}
