<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
       aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-monoicon-grid width="20" height="20"/>
                    <span class="ms-3">{{ __('Dashboard') }}</span>
                </x-nav-link>
            </li>
            @hasanyrole('medic|admin|super-admin')
            <li>
                <x-nav-link href="#">
                    <x-monoicon-calendar width="20" height="20"/>
                    <span class="ms-3">{{ __('View appointments') }}</span>
                </x-nav-link>
            </li>
            @endhasanyrole
            @hasanyrole('super-admin|admin|patient')
            <li>
                <x-nav-link href="{{ route('front.patient.appointments.create') }}"
                            :active="request()->routeIs('front.patient.appointments.create')">
                    <x-monoicon-calendar width="20" height="20"/>
                    <span class="ms-3">{{ __('Schedule an appointment') }}</span>
                </x-nav-link>
            </li>
            @endhasanyrole
            @hasanyrole('admin|super-admin')
            <li>
                <x-nav-link href="{{ route('admin.appointments.index') }}"
                            :active="request()->routeIs('admin.appointments.index')">
                    <x-monoicon-calendar width="20" height="20"/>
                    <span class="ms-3">{{ __('Appointments') }}</span>
                </x-nav-link>
            </li>
            @endhasanyrole
            @hasanyrole('admin|super-admin')
            <li>
                <x-nav-link href="{{ route('patients') }}" :active="request()->routeIs('patients')">
                    <x-monoicon-temperature width="20" height="20"/>
                    <span class="ms-3">{{ __('Patient management') }}</span>
                </x-nav-link>
            </li>
            @endhasanyrole
            @hasanyrole('admin|super-admin')
            <li>
                <button type="button"
                        class="inline-flex items-center p-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-white hover:text-gray-700 dark:hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out w-full rounded-md"
                        aria-controls="dropdown-medics"
                        data-collapse-toggle="dropdown-medics"
                        aria-expanded="{{ request()->routeIs('admin.medics.index', 'admin.specialties.*') ? 'true' : 'false' }}">
                    <x-monoicon-clipboard-list width="20" height="20"/>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('Physician management') }}</span>
                    <x-monoicon-chevron-down width="20" height="20"/>
                </button>
                <ul id="dropdown-medics" class="py-2 space-y-2 {{ request()->routeIs('admin.medics.index', 'admin.specialties.*') ? 'show' : 'hidden' }}">
                    <li>
                        <x-nav-link class="flex items-center w-full p-2 transition duration-75 pl-11"
                                    href="{{ route('admin.medics.index') }}" :active="request()->routeIs('admin.medics.index')">
                            {{ __('Medics') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link class="flex items-center w-full p-2 transition duration-75 pl-11"
                                    href="{{ route('admin.specialties.index') }}"
                                    :active="request()->routeIs('admin.specialties.*')">
                            {{ __('Specialties') }}
                        </x-nav-link>
                    </li>
                </ul>
            </li>
            @endhasanyrole
            @hasanyrole('admin|super-admin')
            <li>
                <button type="button"
                        class="inline-flex items-center p-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-white hover:text-gray-700 dark:hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out w-full rounded-md"
                        aria-controls="dropdown-users"
                        data-collapse-toggle="dropdown-users"
                        aria-expanded="{{ request()->routeIs('users', 'admin.roles.*') ? 'true' : 'false' }}">
                    <x-monoicon-users width="20" height="20"/>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ __('Users management') }}</span>
                    <x-monoicon-chevron-down width="20" height="20"/>
                </button>
                <ul id="dropdown-users" class="py-2 space-y-2 {{ request()->routeIs('users', 'admin.roles.*') ? 'show' : 'hidden' }}">
                    <li>
                        <x-nav-link class="flex items-center w-full p-2 transition duration-75 pl-11"
                                    href="{{ route('users') }}" :active="request()->routeIs('users')">
                            {{ __('Users') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link class="flex items-center w-full p-2 transition duration-75 pl-11"
                                    href="{{ route('admin.roles.index') }}"
                                    :active="request()->routeIs('admin.roles.*')">
                            {{ __('Roles') }}
                        </x-nav-link>
                    </li>
                </ul>
            </li>
            @endhasanyrole
            @hasanyrole('admin|super-admin')
            <li>
                <x-nav-link href="#">
                    <x-monoicon-credit-card width="20" height="20"/>
                    <span class="ms-3">{{ __('Billing') }}</span>
                </x-nav-link>
            </li>
            @endhasanyrole
            @hasanyrole('admin|super-admin')
            <li>
                <x-nav-link href="#">
                    <x-monoicon-bar-chart-alt width="20" height="20"/>
                    <span class="ms-3">{{ __('Analytics') }}</span>
                </x-nav-link>
            </li>
            @endhasanyrole
            <li>
                <x-nav-link href="{{ route('help') }}" :active="request()->routeIs('help')">
                    <x-monoicon-circle-help width="20" height="20"/>
                    <span class="ms-3">{{ __('Help and Support') }}</span>
                </x-nav-link>
            </li>
        </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <li>
                <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    <x-monoicon-user width="20" height="20"/>
                    <span class="ms-3">{{ __('Profile') }}</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#">
                    <x-monoicon-settings width="20" height="20"/>
                    <span class="ms-3">{{ __('Settings') }}</span>
                </x-nav-link>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        <x-monoicon-log-out width="20" height="20"/>
                        <span class="ms-3">{{ __('Log Out') }}</span>
                    </x-nav-link>
                </form>
            </li>

        </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <div x-data="window.themeSwitcher()" x-init="switchTheme()" @keydown.window.tab="switchOn = false"
                 class="flex items-center justify-center space-x-2">
                <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

                <button
                    x-ref="switchButton"
                    type="button"
                    @click="switchOn = ! switchOn; switchTheme()"
                    :class="switchOn ? 'bg-malachite-300' : 'bg-gray-200'"
                    class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10">
                    <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
                          class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                </button>

                <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
                       :class="{ 'text-malachite-600 dark:text-malachite-300': switchOn, 'text-gray-400': ! switchOn }"
                       class="text-sm select-none">
                    {{ __('Dark Mode') }}
                </label>
            </div>
        </ul>
    </div>
</aside>
