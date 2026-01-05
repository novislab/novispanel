<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sign in')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->ensureIsNotRateLimited();

        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (! Auth::attempt(
            ['email' => $this->email, 'password' => $this->password],
            $this->remember
        )) {
            RateLimiter::hit($this->throttleKey(), 60);
            Flux::toast('Invalid credentials. Please try again.', variant: 'danger');
            return;
        }

        RateLimiter::clear($this->throttleKey());
        request()->session()->regenerate();

        $this->redirect(route('dashboard'), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        Flux::toast(
            "Too many login attempts. Please try again in {$seconds} seconds.",
            variant: 'danger'
        );

        throw new \Illuminate\Validation\ValidationException(
            validator: validator([], []),
            errorBag: 'default',
            response: null
        );
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }

    public function render()
    {
        return view('livewire.login');
    }
}
