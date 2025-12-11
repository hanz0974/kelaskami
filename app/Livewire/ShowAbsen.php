<?php

namespace App\Livewire;

use App\Models\absens;
use App\Models\tokenAbsen;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

use Livewire\WithPagination;

#[Title('Absen')]
class ShowAbsen extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public $tokenId;

    public function mount($token)
    {
        $this->tokenId = $token;
    }

    public function render()
    {
        $token = tokenAbsen::with('matakuliah')->findOrFail($this->tokenId);

        $absens = absens::where('token_absen_id', $this->tokenId)
            ->searchMahasiswa($this->search)
            ->with('mahasiswa')
            ->paginate(10);

        return view('livewire.show-absen', [
            'token' => $token,
            'absens' => $absens,
        ]);
    }
}
