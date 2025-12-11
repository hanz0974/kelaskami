<?php

namespace App\Livewire;

use App\Models\materis;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModalMateri extends Component
{
    use WithFileUploads;

    public $kode_mk;

    public $mode;

    public $nama;

    public $kode_materi;

    public $original_kode_materi;

    public $deskripsi;

    public $file_materi;

    public $existingFileMateri;

    public function render()
    {
        return view('livewire.modal-materi');
    }

    // fungsi membuka modal
    #[On('openTambahMateriModal')]
    public function openModal($data)
    {
        $this->dispatch('open-modal-materi');
        $this->reset(['nama', 'kode_materi', 'deskripsi', 'file_materi', 'existingFileMateri']);
        $this->mode = 'create';
        $this->kode_mk = $data['kode_mk'];
    }

    // fungsi membuka modal edit
    #[On('materiSelected')]
    public function openModalEdit($data)
    {
        $this->mode = 'edit';
        $this->original_kode_materi = $data['kode_materi'];
        $materi = materis::findOrFail($this->original_kode_materi);
        $this->kode_materi = $materi->kode_materi;

        if ($materi) {
            $this->nama = $materi->nama;
            $this->kode_mk = $materi->kode_mk;
            $this->deskripsi = $materi->deskripsi;
            $this->existingFileMateri = $materi->file_materi;
        }
        $this->dispatch('open-modal-materi');
    }

    // fungsi menutup modal
    #[On('closeModalMateri')]
    public function closeModalMateri()
    {
        $this->dispatch('close-modal-materi');
    }

    // fungsi menyimpan materi
    public function saveMateri()
    {
        // Logic to save materi goes here
        $validationRules = [
            'nama' => 'required|string|max:255',
            'kode_mk' => 'required|string|exists:matakuliah,kode_mk',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|max:5120', // max 5MB
        ];
        if ($this->mode === 'create') {
            $validationRules['kode_materi'] = 'required|string|unique:materi,kode_materi|min:3';
        } else {
            $validationRules['kode_materi'] = 'required|string|unique:materi,kode_materi,'.$this->original_kode_materi.',kode_materi';
        }

        $validatedData = $this->validate($validationRules);
        if ($this->file_materi) {
            $originalName = $this->file_materi->getClientOriginalName();

            // Sanitasi nama file agar aman
            $originalName = preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $originalName);

            // Simpan file dengan nama asli (di folder storage/app/public/file_materi/)
            $validatedData['file_materi'] = $this->file_materi->storeAs(
                'file_materi',      // folder
                $originalName,      // nama file asli
                'public'            // disk
            );
        } else {
            $validatedData['file_materi'] = $this->existingFileMateri;
        }
        if ($this->mode === 'create') {
            materis::create($validatedData);
            session()->flash('message', 'Materi berhasil ditambahkan!');
            // Notify browser to show an alert and notify other Livewire components
            $this->dispatch('sukses');
            $this->reset(['nama', 'kode_materi', 'deskripsi', 'file_materi', 'existingFileMateri']);
            $this->mode = 'create';
            $this->dispatch('close-modal-materi');

            return $this->redirectRoute('class.materi', ['kode_mk' => $this->kode_mk], navigate: true);
        } else {
            $materi = materis::where('kode_materi', $this->original_kode_materi)->firstOrFail();
            $materi->update($validatedData);
            session()->flash('message', 'Materi berhasil diperbarui!');
            // Notify browser to show an alert and notify other Livewire components
            $this->dispatch('sukses');
            $this->reset(['nama', 'kode_materi', 'deskripsi', 'file_materi', 'existingFileMateri']);
            $this->mode = 'create';
            $this->dispatch('close-modal-materi');

            return $this->redirectRoute('class.materi', ['kode_mk' => $this->kode_mk], navigate: true);
        }
    }
}
