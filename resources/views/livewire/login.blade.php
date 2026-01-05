<div class="min-h-screen flex items-center justify-center">
    <flux:card class="space-y-6 w-full max-w-md">
        <div class="flex justify-center opacity-50">
                <a href="/" wire:navigate class="group flex items-center gap-3">
                    <div>
                        <img src="{{ asset('storage/images/logo/dark.svg') }}" alt="Logo" class="h-8 dark:hidden">
                        <img src="{{ asset('storage/images/logo/light.svg') }}" alt="Logo" class="h-8 hidden dark:block">
                    </div>
                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">{{ config('app.name') }}</span>
                </a>
            </div>
        <div>
            <flux:heading size="xl">{{ $this->isRegistrationMode ? 'Create Account' : 'Sign in' }}</flux:heading>
            <flux:text class="mt-2">
                {{ $this->isRegistrationMode ? 'Create your first account to get started.' : 'Welcome back! Please sign in to continue.' }}
            </flux:text>
        </div>

        <form wire:submit="submit" class="space-y-6">
            @csrf

            @if($this->isRegistrationMode)
                <flux:field>
                    <flux:label>Name</flux:label>
                    <flux:input wire:model.blur="name" type="text" placeholder="Your full name" autocomplete="name" />
                </flux:field>
            @endif

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input wire:model.blur="email" type="email" placeholder="Your email address" autocomplete="email" />
            </flux:field>

            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>Password</flux:label>
                    @if(!$this->isRegistrationMode)
                        <flux:link href="#" wire:navigate variant="subtle" class="text-sm">Forgot password?</flux:link>
                    @endif
                </div>
                <flux:input wire:model.blur="password" type="password" placeholder="Your password" viewable autocomplete="{{ $this->isRegistrationMode ? 'new-password' : 'current-password' }}" />
            </flux:field>

            @if($this->isRegistrationMode)
                <flux:field>
                    <flux:label>Confirm Password</flux:label>
                    <flux:input wire:model.blur="password_confirmation" type="password" placeholder="Confirm your password" viewable autocomplete="new-password" />
                </flux:field>
            @else
                <flux:checkbox wire:model.live="remember" label="Remember me for 30 days" />
            @endif

            <flux:button type="submit" variant="primary" class="w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">
                    {{ $this->isRegistrationMode ? 'Create Account' : 'Log in' }}
                </span>
                <span wire:loading wire:target="submit">
                    {{ $this->isRegistrationMode ? 'Creating account...' : 'Signing in...' }}
                </span>
            </flux:button>
        </form>
    </flux:card>
</div>
