<?php

namespace App\Livewire;

use App\Models\materis;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Materi')]
class Materi extends Component
{
    use WithPagination;
    public $materis;
    public $kode_mk;
    public $mode;
    #[Url]
    public $search = '';

    public function tambahMateri()
    {
        $this->dispatch('openTambahMateriModal', data: [
            'kode_mk' => $this->kode_mk,
        ]);
    }
    public function downloadMateri($file_materi)
    {
        return Storage::disk('public')->download($file_materi);
    }

    public function deleteMateri($kode_materi)
    {
        $materi = materis::findOrFail($kode_materi);
        $materi->delete();
        $this->materis = materis::all();
        session()->flash('message', 'Materi berhasil dihapus!');
        $this->dispatch('sukses');
        return $this->redirectRoute('class.materi', ['kode_mk' => $this->kode_mk], navigate: true);
    }
    public function editMateri($kode_materi)
    {
        $this->dispatch('materiSelected', data: [
            'kode_materi' => $kode_materi,
        ]);
    }
    public function deleteAll(){
        materis::truncate();
    }
    public function render()
    {
        return view('livewire.materi', [
            'materik' => materis::search($this->search)->latest()->paginate(10),
        ]);
    }
}
