@auth
    <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800">
        <flux:sidebar.header>
            <flux:sidebar.brand href="#" logo="{{ asset('storage/images/logo/dark.svg') }}"
                logo:dark="{{ asset('storage/images/logo/light.svg') }}" name="{{ config('app.name') }}" />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>
        <flux:sidebar.nav>
            <flux:sidebar.item icon="squares-2x2" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')">
                Dashboard</flux:sidebar.item>
            <flux:sidebar.item icon="calendar" href="#">Calendar</flux:sidebar.item>
            <flux:sidebar.group expandable icon="star" heading="Favorites" class="grid">
                <flux:sidebar.item href="#">Marketing site</flux:sidebar.item>
                <flux:sidebar.item href="#">Android app</flux:sidebar.item>
                <flux:sidebar.item href="#">Brand guidelines</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>
        <flux:sidebar.spacer />
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile iconTrailing='chevron-up-down' avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />
            <flux:navmenu>
                <div class="flex items-start justify-between rounded-lg">
                    <div class="flex flex-col">
                        <flux:heading level="3">My Account</flux:heading>
                        <flux:text class="text-sm opacity-60">novislab.dev@gmail.com</flux:text>
                    </div>
                    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="ghost" size="sm" aria-label="Toggle dark mode" />
                </div>
                <flux:menu.separator />
                <flux:navmenu.item icon="arrow-right-start-on-rectangle" href="#">Account</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-right-start-on-rectangle" href="#">Profile</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-right-start-on-rectangle" href="#">Billing</flux:navmenu.item>
                <flux:menu.separator />
                <flux:navmenu.item href="#" icon="arrow-right-start-on-rectangle" variant="danger">Logout
                </flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:sidebar>
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="start">
            <flux:profile iconTrailing='chevron-up-down' avatar="/img/demo/user.png" />
            <flux:navmenu>
                <div class="flex items-start justify-between rounded-lg">
                    <div class="flex flex-col">
                        <flux:heading level="3">My Account</flux:heading>
                        <flux:text class="text-sm opacity-60">novislab.dev@gmail.com</flux:text>
                    </div>
                    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="ghost" size="sm" aria-label="Toggle dark mode" />
                </div>
                <flux:menu.separator />
                <flux:navmenu.item icon="arrow-right-start-on-rectangle" href="#">Account</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-right-start-on-rectangle" href="#">Profile</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-right-start-on-rectangle" href="#">Billing</flux:navmenu.item>
                <flux:menu.separator />
                <flux:navmenu.item href="#" icon="arrow-right-start-on-rectangle" variant="danger">Logout
                </flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:header>
@endauth
