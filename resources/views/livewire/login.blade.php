<div class="min-h-screen flex items-center justify-center">
    <flux:card class="space-y-6 w-full max-w-md">
        <div class="flex justify-center opacity-50">
                <a href="/" class="group flex items-center gap-3">
                    <div>
                        <img src="{{ asset('storage/images/logo/dark.svg') }}" alt="Logo" class="h-8 dark:hidden">
                        <img src="{{ asset('storage/images/logo/light.svg') }}" alt="Logo" class="h-8 hidden dark:block">
                    </div>
                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">{{ config('app.name') }}</span>
                </a>
            </div>
        <div>
            <flux:heading size="xl">Sign in</flux:heading>
            <flux:text class="mt-2">Welcome back! Please sign in to continue.</flux:text>
        </div>

        <form wire:submit="login" class="space-y-6">
            @csrf
            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input wire:model.blur="email" type="email" placeholder="Your email address" autocomplete="email" />
            </flux:field>

            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>Password</flux:label>
                    <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
                </div>
                <flux:input wire:model.blur="password" type="password" placeholder="Your password" viewable autocomplete="current-password" />
            </flux:field>

            <flux:checkbox wire:model.live="remember" label="Remember me for 30 days" />

            <flux:button type="submit" variant="primary" class="w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="login">Log in</span>
                <span wire:loading wire:target="login">Signing in...</span>
            </flux:button>
        </form>

        <flux:subheading class="text-center mt-4">
            Don't have an account? <flux:link href="#">Sign up for free</flux:link>
        </flux:subheading>
    </flux:card>
</div>
