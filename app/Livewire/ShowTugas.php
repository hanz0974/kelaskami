<?php

namespace App\Livewire;

use App\Models\jawabanTugas;
use App\Models\tugass;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Tugas')]
class ShowTugas extends Component
{
    public $kode_tugas;

    public $jawabantugas;

    public $kode_mk;


    public function downloadtugas($file_tugas)
    {
        return Storage::disk('public')->download($file_tugas);
    }

    public function delete($data)
    {
        $jwbn = jawabanTugas::findOrFail($data);
        $jwbn->delete();
        session()->flash('message', 'Jawaban berhasil dihapus!');

        return $this->redirectRoute('class.show', ['kode_tugas' => $this->kode_tugas, 'kode_mk' => $this->kode_mk], navigate: true);
    }

    public function render()
    {
        $tugas = tugass::findOrFail($this->kode_tugas);
        $nim = auth()->user()->mahasiswa->nim;
        $this->jawabantugas = jawabanTugas::where('nim', $nim)
            ->where('kode_tugas', $this->kode_tugas) // tambahkan filter tugas spesifik
            ->first();
       
        return view('livewire.show-tugas', [
            'tugas' => $tugas,
            'jawabantugas' => $this->jawabantugas,
        ]);
    }
}
