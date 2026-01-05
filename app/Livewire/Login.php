<?php

namespace App\Livewire;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sign in')]
class Login extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $remember = false;

    #[Computed]
    public function isRegistrationMode(): bool
    {
        return User::count() === 0;
    }

    public function submit(): void
    {
        if ($this->isRegistrationMode) {
            $this->register();
        } else {
            $this->login();
        }
    }

    protected function register(): void
    {
        if (User::count() > 0) {
            Flux::toast('Registration is disabled.', variant: 'danger');

            return;
        }

        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                ],
            ], [
                'name.required' => 'Please enter your name.',
                'name.max' => 'Name cannot exceed 255 characters.',
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Please enter a valid email address.',
                'email.regex' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'password.required' => 'Please enter a password.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.regex' => 'Password must contain uppercase, lowercase, and a number.',
                'password.confirmed' => 'Password confirmation does not match.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                Flux::toast($error, variant: 'danger');
            }

            throw $e;
        }

        $user = User::create([
            'name' => trim(strip_tags($validated['name'])),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user, true);
        request()->session()->regenerate();

        Flux::toast('Account created successfully! Welcome aboard.', variant: 'success');
        $this->redirect($this->getIntendedUrl(), navigate: true);
    }

    protected function login(): void
    {
        $this->ensureIsNotRateLimited();

        try {
            $this->validate([
                'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'password' => 'required|string|min:6',
            ], [
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Please enter a valid email address.',
                'email.regex' => 'Please enter a valid email address.',
                'password.required' => 'Please enter your password.',
                'password.min' => 'Password must be at least 6 characters.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                Flux::toast($error, variant: 'danger');
            }

            throw $e;
        }

        $sanitizedEmail = strtolower(trim($this->email));

        if (! Auth::attempt(
            ['email' => $sanitizedEmail, 'password' => $this->password],
            $this->remember
        )) {
            RateLimiter::hit($this->throttleKey(), 60);
            Flux::toast('Invalid credentials. Please try again.', variant: 'danger');

            return;
        }

        RateLimiter::clear($this->throttleKey());
        request()->session()->regenerate();

        Flux::toast('Welcome back!', variant: 'success');
        $this->redirect($this->getIntendedUrl(), navigate: true);
    }

    protected function getIntendedUrl(): string
    {
        return session()->pull('url.intended', route('dashboard'));
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
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    public function render()
    {
        return view('livewire.login');
    }
}
