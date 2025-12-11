<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\matakuliah;
use Livewire\Attributes\On;

class TambahMk extends Component
{
    use WithFileUploads;
    public $mode = 'create';
    public $kode_mk;
    public $nama;
    public $foto;
    public $existingFoto;
    public $sks;
    public $semester;
    public $kelas;


    // Open modal to create new record
    #[On('openTambahMkModal')]
    public function openCreate()
    {
        $this->reset(['kode_mk', 'nama', 'foto', 'existingFoto', 'kelas', 'sks', 'semester']);
        $this->mode = 'create';
        $this->dispatch('open-tambah-mk');
    }

    // Open modal to edit existing record (accept kode_mk)
    #[On('matakuliahSelected')]
    public function edit($data)
    {
        $kode_mk = $data['kode_mk'];
        $mk = matakuliah::findOrFail($kode_mk);
        $this->mode = 'edit';
        $this->kode_mk = $mk->kode_mk;
        $this->nama = $mk->nama;
        $this->kelas = $mk->kelas;
        $this->sks = $mk->sks;
        $this->semester = $mk->semester;
        $this->existingFoto = $mk->foto;
        $this->foto = null;
        $this->dispatch('open-tambah-mk');
    }

    public function save()
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
            'sks' => 'required|integer',
            'semester' => 'required|integer',
            'foto' => 'nullable|image|max:2048',
        ];

        if ($this->mode === 'create') {
            $rules['kode_mk'] = 'required|string|unique:matakuliah,kode_mk';
        } else {
            // When editing we don't allow changing primary key kode_mk, so no unique rule here
            $rules['kode_mk'] = 'required|string';
        }

        $validatedData = $this->validate($rules);
        if ($this->foto) {
            $validatedData['foto'] = $this->foto->store('foto', 'public');
        } else if ($this->mode === 'edit' && $this->existingFoto) {
            // Retain existing foto if no new foto uploaded during edit
            $validatedData['foto'] = $this->existingFoto;
        }
        if ($this->mode === 'create') {
            matakuliah::create($validatedData);
            session()->flash('message', 'Matakuliah berhasil ditambahkan!');
            // Notify browser to show an alert and notify other Livewire components
            $this->dispatch('sukses');
            $this->reset(['kode_mk', 'nama', 'foto', 'existingFoto', 'kelas', 'sks', 'semester']);
            $this->mode = 'create';

            $this->dispatch('close-tambah-mk');
            return $this->redirectRoute('home', navigate: true);
        } else {
            $kode = $this->kode_mk;
            // Prevent changing primary key; remove kode_mk from update payload
            unset($validatedData['kode_mk']);
            $record = matakuliah::findOrFail($kode);
            $record->update($validatedData);
            session()->flash('message', 'Matakuliah berhasil diperbarui!');
            $this->dispatch('sukses');
            $this->reset(['kode_mk', 'nama', 'foto', 'existingFoto', 'kelas', 'sks', 'semester']);
            $this->mode = 'create';

            $this->dispatch('close-tambah-mk');
            return $this->redirectRoute('home', navigate: true);
        }
    }
    // Reset form and close modal (used by cancel/close buttons)
    public function resetToCreate()
    {
        $this->reset(['kode_mk', 'nama', 'foto', 'existingFoto', 'kelas', 'sks', 'semester']);
        $this->mode = 'create';
        $this->dispatch('close-tambah-mk');
    }
    public function render()
    {
        return view('livewire.tambah-mk');
    }
}
