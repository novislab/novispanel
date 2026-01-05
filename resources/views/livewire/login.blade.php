<div class="min-h-screen flex items-center justify-center">
    <flux:card class="w-full max-w-md bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:card class="space-y-6 w-full max-w-md bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
            <div>
                <flux:heading size="xl">Sign in</flux:heading>
                <flux:text class="mt-2">Welcome back! Please sign in to continue.</flux:text>
            </div>

            <div class="space-y-6">
                <flux:input label="Email" type="email" placeholder="Your email address" />
                <flux:field>
                    <div class="mb-3 flex justify-between">
                        <flux:label>Password</flux:label>
                        <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
                    </div>
                    <flux:input type="password" placeholder="Your password" viewable />
                    <flux:error name="password" />
                </flux:field>
                <flux:checkbox label="Remember me for 30 days" />
            </div>

            <div class="space-y-2">
                <flux:button variant="primary" class="w-full">Log in</flux:button>
            </div>
        </flux:card>
        <flux:subheading class="text-center mt-4">
            First time around here? <flux:link href="#">Sign up for free</flux:link>
        </flux:subheading>
    </flux:card>
</div>
