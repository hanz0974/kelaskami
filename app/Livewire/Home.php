<?php

namespace App\Livewire;

use App\Models\matakuliah;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Home extends Component
{
    #[Url]
    public $search = '';

    public function show($kode_mk)
    {
        $matakuliah = matakuliah::where('kode_mk', $kode_mk)->firstOrFail();
        $this->dispatch('matakuliahSelected', data: [
            'kode_mk' => $matakuliah->kode_mk,
        ]);
    }
    public function tambahMk()
    {
        $this->dispatch('openTambahMkModal', data: [
            'mode' => 'create'
        ]);
    }
    public function delete($kode_mk)
    {
        $mk = matakuliah::findOrFail($kode_mk);
        $mk->delete();

        // Optionally, you can dispatch an event to notify other components
        session()->flash('message', 'Matakuliah berhasil dihapus!');
        $this->dispatch('sukses');
        return $this->redirectRoute('home', navigate: true);
    }
    public function render()
    {
        if ($this->search) {
            return view('livewire.home', [
                'matkul' => matakuliah::where('nama', 'LIKE', '%' . $this->search . '%')->get(),
            ]);
        }
        return view('livewire.home', [
            'matkul' => matakuliah::all(),
        ]);
    }
}
