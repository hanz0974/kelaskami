<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\jawabanTugas;
use Livewire\Attributes\On;

class ModalJawabanTugas extends Component
{
    use WithFileUploads;
    public $kode_mk;
    public $kode_tugas;
    public $nim;
    public $jawaban_file;
    public $deskripsi;


    #[On('upload-tugas')]
    public function openModal($data)
    {   
        $this->kode_tugas = $data;
    }

    public function save()
    {
        $this->validate([
            'jawaban_file' => 'required|file|mimes:pdf,docx,zip|max:2048',
        ]);

        $path = $this->jawaban_file->store('jawaban_tugas', 'public');

        jawabanTugas::create([
            'kode_tugas'   => $this->kode_tugas,
            'nim'          => auth()->user()->mahasiswa->nim,
            'deskripsi'    => $this->deskripsi,
            'jawaban_tugas'=> $path,
            'status'       => 'submitted',
        ]);

        $this->reset(['jawaban_file','deskripsi']);
        $this->dispatch('close-modal-tugas');
        session()->flash('message', 'Jawaban berhasil diupload!');
        return $this->redirectRoute('class.show', ['kode_tugas' => $this->kode_tugas,'kode_mk' => $this->kode_mk], navigate: true);
    }

    public function render()
    {   
        return view('livewire.modal-jawaban-tugas',[
            'kode_tugas' => $this->kode_tugas,
        ]);
    }
}
