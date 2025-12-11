<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\matakuliah;
use Livewire\Attributes\Title;

#[Title('Kelas')]
class Kelas extends Component
{ 
    public $kode_mk;
    public $nama;
    public function render()
    {
        $this->nama = matakuliah::where('kode_mk', $this->kode_mk)->value('nama');
        return view('livewire.kelas');
    } 

    
}
