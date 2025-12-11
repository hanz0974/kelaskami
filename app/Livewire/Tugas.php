<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\matakuliah;
use Livewire\Attributes\Title;
use App\Models\tugass;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Storage;

#[Title('Tugas')]
class Tugas extends Component
{

    use WithPagination;
    public $tugass;
    public $kode_mk;
    public $mode;
    #[Url]
    public $search = '';

    public function tambahtugas()
    {
        $this->dispatch('openTambahtugasModal', data: [
            'kode_mk' => $this->kode_mk,
        ]);
    }
    public function downloadtugas($file_tugas)
    {
        return Storage::disk('public')->download($file_tugas);
    }

    public function deletetugas($kode_tugas)
    {
        $tugas = tugass::findOrFail($kode_tugas);
        $tugas->delete();
        $this->tugass = tugass::all();
        session()->flash('message', 'tugas berhasil dihapus!');
        $this->dispatch('sukses');
        return $this->redirectRoute('class.tugas', ['kode_mk' => $this->kode_mk], navigate: true);
    }
    public function edittugas($kode_tugas)
    {
        $this->dispatch('tugasSelected', data: [
            'kode_tugas' => $kode_tugas,
        ]);
    }
    public function deleteAll(){
        tugass::truncate();
    }
    public function render()
    {
        return view('livewire.tugas', [
            'tugas' => tugass::search($this->search)->latest()->paginate(10),
        ]);
    }
    
}
