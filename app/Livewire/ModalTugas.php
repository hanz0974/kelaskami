<?php

namespace App\Livewire;

use App\Models\tugass;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Modaltugas extends Component
{
    use WithFileUploads;

    public $kode_mk;

    public $mode;

    public $title;

    public $kode_tugas;

    public $original_kode_tugas;

    public $deadline;

    public $deskripsi;

    public $file_tugas;

    public $existingFiletugas;

    public function render()
    {
        return view('livewire.modal-tugas');
    }

    // fungsi membuka modal
    #[On('openTambahtugasModal')]
    public function openModal($data)
    {
        $this->dispatch('open-modal-tugas');
        $this->reset(['title', 'kode_tugas', 'deadline', 'deskripsi', 'file_tugas', 'existingFiletugas']);
        $this->mode = 'create';
        $this->kode_mk = $data['kode_mk'];
    }

    // fungsi membuka modal edit
    #[On('tugasSelected')]
    public function openModalEdit($data)
    {
        $this->mode = 'edit';
        $this->original_kode_tugas = $data['kode_tugas'];
        $tugas = tugass::findOrFail($this->original_kode_tugas);
        $this->kode_tugas = $tugas->kode_tugas;
        if ($tugas) {
            $this->title = $tugas->title;
            $this->kode_mk = $tugas->kode_mk;
            $this->kode_tugas = $tugas->kode_tugas;
            $this->deadline = $tugas->deadline;
            $this->deskripsi = $tugas->deskripsi;
            $this->existingFiletugas = $tugas->file_tugas;
        }
        $this->dispatch('open-modal-tugas');
    }

    // fungsi menutup modal
    #[On('closeModaltugas')]
    public function closeModaltugas()
    {
        $this->dispatch('close-modal-tugas');
    }

    // fungsi menyimpan tugas
    public function savetugas()
    {
        // Logic to save tugas goes here
        $validationRules = [
            'title' => 'required|string|max:255',
            'kode_mk' => 'required|string|exists:matakuliah,kode_mk',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'file_tugas' => 'nullable|file|max:5120',
        ];
        if ($this->mode === 'create') {
            $validationRules['kode_tugas'] = 'required|string|unique:tugas,kode_tugas|min:3';
        } else {
            $validationRules['kode_tugas'] = 'required|string|unique:tugas,kode_tugas,'.$this->original_kode_tugas.',kode_tugas';
        }
        $validatedData = $this->validate($validationRules);
        if ($this->file_tugas) {
            $originalName = $this->file_tugas->getClientOriginalName();

            // Sanitasi title file agar aman
            $originalName = preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $originalName);

            // Simpan file dengan title asli (di folder storage/app/public/file_tugas/)
            $validatedData['file_tugas'] = $this->file_tugas->storeAs(
                'file_tugas',      // folder
                $originalName,      // title file asli
                'public'            // disk
            );
        } else {
            $validatedData['file_tugas'] = $this->existingFiletugas;
        }
        $validatedData['nip'] = Auth()->user()->dosen->nip;
        if ($this->mode === 'create') {
            tugass::create($validatedData);
            session()->flash('message', 'tugas berhasil ditambahkan!');
            // Notify browser to show an alert and notify other Livewire components
            $this->dispatch('sukses');
            $this->reset(['title', 'kode_tugas', 'deadline', 'deskripsi', 'file_tugas', 'existingFiletugas']);
            $this->mode = 'create';
            $this->dispatch('close-modal-tugas');

            return $this->redirectRoute('class.tugas', ['kode_mk' => $this->kode_mk], navigate: true);
        } else {
            $tugas = tugass::where('kode_tugas', $this->original_kode_tugas)->firstOrFail();
            $tugas->update($validatedData);
            session()->flash('message', 'tugas berhasil diperbarui!');
            // Notify browser to show an alert and notify other Livewire components
            $this->dispatch('sukses');
            $this->reset(['title', 'kode_tugas', 'deadline', 'deskripsi', 'file_tugas', 'existingFiletugas']);
            $this->mode = 'create';
            $this->dispatch('close-modal-tugas');

            return $this->redirectRoute('class.tugas', ['kode_mk' => $this->kode_mk], navigate: true);
        }
    }
}
