<?php

namespace App\Livewire\Guru;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guru')]
class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login() 
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'Email atau Password salah.');
            return;
        }

        if (! Auth::user()->hasRole('guru')) {
            Auth::logout();
            $this->addError('email', 'Email atau Password Salah.');
            return;
        }

        request()->session()->regenerate();
        $this->redirectRoute('guru-rpp.index');
    }

    public function render()
    {
        return view('livewire.guru.login-form');
    }
}
