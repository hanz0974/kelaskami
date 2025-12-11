<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[\Livewire\Attributes\Layout('layouts.guest')]
#[Title('Register')]
class Register extends Component
{
    #[Validate('required|string|min:3')]
    public $name;

    #[Validate('required|string|min:3')]
    public $nim;

    #[Validate('required|string|min:4')]
    public $angkatan;

    #[Validate('required')]
    public $prodi;

    #[Validate('required')]
    public $jenisKelamin;

    #[Validate('required|email:dns|min:3')]
    public $email;

    #[Validate('required|string|min:6')]
    public $password;

    #[Validate('required|same:password|min:6')]
    public $password_confirmation;

    #[Validate('required')]
    public $role;

    public function register()
    {
        $this->validate();

        $user = \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ]);
        $user->mahasiswa()->create([
            'nim' => $this->nim,
            'nama' => $this->name,
            'jenis_kelamin' => $this->jenisKelamin,
            'prodi' => $this->prodi,
            'angkatan' => $this->angkatan,
            'foto' => null,
        ]);

        session()->flash('absen', 'Registrasi berhasil! Silakan login.');

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
