<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ujian')]
class Ujian extends Component
{   
    public $kode_mk;
    public function render()
    {
        return view('livewire.ujian');
    }
}
