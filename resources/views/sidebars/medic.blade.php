<!-- Sidebar for medics -->
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-monoicon-grid width="20" height="20" />
                    <span class="ms-3">{{ __('Dashboard') }}</span>

                </x-nav-link>
            </li>
        </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <li>
                <x-nav-link href="#">
                    <x-monoicon-calendar  width="20" height="20"/>
                    <span class="ms-3">{{ __('View appointments') }}</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    <x-monoicon-user width="20" height="20" />
                    <span class="ms-3">{{ __('Profile') }}</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#">
                    <x-monoicon-settings width="20" height="20" />
                    <span class="ms-3">{{ __('Settings') }}</span>
                </x-nav-link>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        <x-monoicon-log-out width="20" height="20" />
                        <span class="ms-3">{{ __('Log Out') }}</span>
                    </x-nav-link>
                </form>
            </li>

        </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <div x-data="window.themeSwitcher()" x-init="switchTheme()" @keydown.window.tab="switchOn = false" class="flex items-center justify-center space-x-2">
                <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

                <button
                    x-ref="switchButton"
                    type="button"
                    @click="switchOn = ! switchOn; switchTheme()"
                    :class="switchOn ? 'bg-malachite-300' : 'bg-gray-200'"
                    class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10">
                    <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                </button>

                <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
                       :class="{ 'text-malachite-600 dark:text-malachite-300': switchOn, 'text-gray-400': ! switchOn }"
                       class="text-sm select-none">
                    Dark Mode
                </label>
            </div>
        </ul>
    </div>
</aside>
