<div>
    <flux:card class="space-y-6">
    <div>
        <flux:heading size="lg">Log in to your account</flux:heading>
        <flux:text class="mt-2">Welcome back!</flux:text>
    </div>

    <div class="space-y-6">
        <flux:input label="Email" type="email" placeholder="Your email address" />

        <flux:field>
            <div class="mb-3 flex justify-between">
                <flux:label>Password</flux:label>

                <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
            </div>

            <flux:input type="password" placeholder="Your password" />

            <flux:error name="password" />
        </flux:field>
    </div>

    <div class="space-y-2">
        <flux:button variant="primary" class="w-full">Log in</flux:button>

        <flux:button variant="ghost" class="w-full">Sign up for a new account</flux:button>
    </div>
</flux:card>
</div>
