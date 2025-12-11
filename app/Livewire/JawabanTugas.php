<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class JawabanTugas extends Component
{
    use WithPagination;
    public $kode_tugas;
    public $kode_mk;
    public $nilai;
     #[Url]
    public $search = '';
    public function updatejawaban($nim)
    {
        $this->validate([
            'nilai' => 'numeric|min:0',
        ]);
        \App\Models\jawabanTugas::where('nim', $nim)
            ->update(['nilai' => $this->nilai]);
        session()->flash('message', 'Nilai berhasil diubah!');
        return $this->redirectRoute('class.jawaban', ['kode_tugas' => $this->kode_tugas, 'kode_mk' => $this->kode_mk], navigate: true);
    }

    public function render()
    {
        $jawabantugas = \App\Models\jawabanTugas::with('mahasiswa')
            ->where('kode_tugas', $this->kode_tugas)
            ->when($this->search, function ($query) {
                $query->whereHas('mahasiswa', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%');
                });
            })
            ->get();
        return view('livewire.jawaban-tugas', [
            'jawaban' => $jawabantugas,
        ]);
    }
}
