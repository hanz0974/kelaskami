<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;


#[Title('Login')]
#[\Livewire\Attributes\Layout('layouts.guest')]
class Login extends Component
{
    public $email;
    public $password;
    public function login(){
        $this->validate([
            'email' => 'required|email:dns|min:3',
            'password' => 'required'
        ]);
        if(Auth::attempt([
            'email' => $this->email,
            'password'=> $this->password
        ])) {
            session()->regenerate();

            return $this->redirect('/', navigate: true);
        }
        $this->addError('login', 'Email atau Password salah');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
