<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"height="23" viewBox="0 0 23 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.455811 0.845459V10.6658H10.2762V0.845459H0.455811ZM7.82109 8.21074H2.9109V3.30055H7.82109V8.21074ZM0.455811 13.1209V22.9413H10.2762V13.1209H0.455811ZM7.82109 20.4862H2.9109V15.576H7.82109V20.4862ZM12.7313 0.845459V10.6658H22.5517V0.845459H12.7313ZM20.0966 8.21074H15.1864V3.30055H20.0966V8.21074ZM12.7313 13.1209V22.9413H22.5517V13.1209H12.7313ZM20.0966 20.4862H15.1864V15.576H20.0966V20.4862Z" />
                    </svg>
                    <span class="ms-3">{{ __('Dashboard') }}</span>

                </x-nav-link>
                {{--<a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>--}}
            </li>
            <li>
                <x-nav-link href="#">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="23" height="25" viewBox="0 0 23 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.0966 2.46852H18.869V0.0134277H16.4139V2.46852H6.59355V0.0134277H4.13845V2.46852H2.9109C1.54833 2.46852 0.468086 3.57331 0.468086 4.92362L0.455811 22.1093C0.455811 23.4596 1.54833 24.5644 2.9109 24.5644H20.0966C21.4469 24.5644 22.5517 23.4596 22.5517 22.1093V4.92362C22.5517 3.57331 21.4469 2.46852 20.0966 2.46852ZM20.0966 22.1093H2.9109V9.8338H20.0966V22.1093ZM20.0966 7.37871H2.9109V4.92362H20.0966V7.37871ZM7.82109 14.744H5.366V12.2889H7.82109V14.744ZM12.7313 14.744H10.2762V12.2889H12.7313V14.744ZM17.6415 14.744H15.1864V12.2889H17.6415V14.744ZM7.82109 19.6542H5.366V17.1991H7.82109V19.6542ZM12.7313 19.6542H10.2762V17.1991H12.7313V19.6542ZM17.6415 19.6542H15.1864V17.1991H17.6415V19.6542Z" />
                    </svg>
                    <span class="ms-3">Gestión de citas</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="25" height="24" viewBox="0 0 25 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.3241 0.938721H2.68337C1.32079 0.938721 0.228271 2.03124 0.228271 3.39381V18.1244C0.228271 19.4747 1.32079 20.5795 2.68337 20.5795H7.59355V23.0346H17.4139V20.5795H22.3241C23.6744 20.5795 24.7792 19.4747 24.7792 18.1244V3.39381C24.7792 2.03124 23.6744 0.938721 22.3241 0.938721ZM22.3241 18.1244H2.68337V3.39381H22.3241V18.1244Z" />
                        <path d="M14.9588 7.38334H5.13846V9.22466H14.9588V7.38334Z" />
                        <path d="M18.0277 9.22466H19.869V7.38334H18.0277V5.84891H16.1864V10.7591H18.0277V9.22466Z" />
                        <path d="M19.869 12.2935H10.0486V14.1349H19.869V12.2935Z" />
                        <path d="M6.97978 15.6693H8.8211V10.7591H6.97978V12.2935H5.13846V14.1349H6.97978V15.6693Z" />
                    </svg>
                    <span class="ms-3">Facturación</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="30" height="16" viewBox="0 0 30 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.90701 9.45385C6.25732 9.45385 7.36211 8.34906 7.36211 6.99876C7.36211 5.64846 6.25732 4.54366 4.90701 4.54366C3.55671 4.54366 2.45192 5.64846 2.45192 6.99876C2.45192 8.34906 3.55671 9.45385 4.90701 9.45385ZM6.29414 10.8042C5.83995 10.7305 5.38576 10.6814 4.90701 10.6814C3.69174 10.6814 2.53785 10.9392 1.49443 11.3934C0.586049 11.7862 -0.00317383 12.67 -0.00317383 13.6643V15.5916H5.52079V13.6152C5.52079 12.5964 5.80312 11.6389 6.29414 10.8042ZM24.5478 9.45385C25.8981 9.45385 27.0029 8.34906 27.0029 6.99876C27.0029 5.64846 25.8981 4.54366 24.5478 4.54366C23.1975 4.54366 22.0927 5.64846 22.0927 6.99876C22.0927 8.34906 23.1975 9.45385 24.5478 9.45385ZM29.458 13.6643C29.458 12.67 28.8687 11.7862 27.9603 11.3934C26.9169 10.9392 25.763 10.6814 24.5478 10.6814C24.069 10.6814 23.6148 10.7305 23.1606 10.8042C23.6517 11.6389 23.934 12.5964 23.934 13.6152V15.5916H29.458V13.6643ZM19.9322 10.2518C18.496 9.61343 16.7283 9.14697 14.7274 9.14697C12.7265 9.14697 10.9588 9.62571 9.52259 10.2518C8.19684 10.841 7.36211 12.1667 7.36211 13.6152V15.5916H22.0927V13.6152C22.0927 12.1667 21.2579 10.841 19.9322 10.2518ZM9.90313 13.1365C10.0136 12.8542 10.0627 12.6578 11.0202 12.2895C12.2109 11.823 13.463 11.6021 14.7274 11.6021C15.9918 11.6021 17.2439 11.823 18.4346 12.2895C19.3798 12.6578 19.4289 12.8542 19.5517 13.1365H9.90313ZM14.7274 3.31612C15.4025 3.31612 15.9549 3.86851 15.9549 4.54366C15.9549 5.21881 15.4025 5.77121 14.7274 5.77121C14.0522 5.77121 13.4998 5.21881 13.4998 4.54366C13.4998 3.86851 14.0522 3.31612 14.7274 3.31612ZM14.7274 0.861023C12.6897 0.861023 11.0447 2.50594 11.0447 4.54366C11.0447 6.58139 12.6897 8.22631 14.7274 8.22631C16.7651 8.22631 18.41 6.58139 18.41 4.54366C18.41 2.50594 16.7651 0.861023 14.7274 0.861023Z" />
                    </svg>
                    <span class="ms-3">{{ __('Gestión de Usuarios') }}</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="25" height="23" viewBox="0 0 25 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.7792 0.417969L22.7292 2.46797L20.6915 0.417969L18.6415 2.46797L16.5915 0.417969L14.5537 2.46797L12.5037 0.417969L10.4537 2.46797L8.41601 0.417969L6.36601 2.46797L4.316 0.417969L2.27828 2.46797L0.228271 0.417969V20.0587C0.228271 21.409 1.33306 22.5138 2.68337 22.5138H22.3241C23.6744 22.5138 24.7792 21.409 24.7792 20.0587V0.417969ZM11.2762 20.0587H2.68337V12.6934H11.2762V20.0587ZM22.3241 20.0587H13.7313V17.6036H22.3241V20.0587ZM22.3241 15.1485H13.7313V12.6934H22.3241V15.1485ZM22.3241 10.2383H2.68337V6.5557H22.3241V10.2383Z" />
                    </svg>
                    <span class="ms-3">Gestión del personal</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="31" height="30" viewBox="0 0 31 30" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.5831 19.767C14.5831 20.2755 14.9953 20.6877 15.5037 20.6877C16.0122 20.6877 16.4244 20.2755 16.4244 19.767V6.87775C16.4244 6.36929 16.0122 5.95709 15.5037 5.95709C14.9953 5.95709 14.5831 6.36929 14.5831 6.87775L14.5831 19.767Z" />
                        <path d="M9.97976 19.767C9.97976 20.2755 10.392 20.6877 10.9004 20.6877C11.4089 20.6877 11.8211 20.2755 11.8211 19.767L11.8211 12.4017C11.8211 11.8932 11.4089 11.4811 10.9004 11.4811C10.392 11.4811 9.97976 11.8932 9.97976 12.4017L9.97976 19.767Z" />
                        <path d="M7.21778 22.529C6.70931 22.529 6.29712 22.9412 6.29712 23.4496C6.29712 23.9581 6.70931 24.3703 7.21778 24.3703H23.7897C24.2981 24.3703 24.7103 23.9581 24.7103 23.4496C24.7103 22.9412 24.2981 22.529 23.7897 22.529H7.21778Z" />
                        <path d="M20.107 20.6877C19.5986 20.6877 19.1864 20.2755 19.1864 19.767V12.4017C19.1864 11.8932 19.5986 11.4811 20.107 11.4811C20.6155 11.4811 21.0277 11.8932 21.0277 12.4017V19.767C21.0277 20.2755 20.6155 20.6877 20.107 20.6877Z" />
                    </svg>
                    <span class="ms-3">Estadísticas</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('help') }}" :active="request()->routeIs('help')">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="25" height="26" viewBox="0 0 25 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.2762 20.2267H13.7313V17.7716H11.2762V20.2267ZM12.5037 0.585938C5.72768 0.585938 0.228271 6.08535 0.228271 12.8614C0.228271 19.6375 5.72768 25.1369 12.5037 25.1369C19.2798 25.1369 24.7792 19.6375 24.7792 12.8614C24.7792 6.08535 19.2798 0.585938 12.5037 0.585938ZM12.5037 22.6818C7.09026 22.6818 2.68337 18.2749 2.68337 12.8614C2.68337 7.44793 7.09026 3.04103 12.5037 3.04103C17.9172 3.04103 22.3241 7.44793 22.3241 12.8614C22.3241 18.2749 17.9172 22.6818 12.5037 22.6818ZM12.5037 5.49613C9.79086 5.49613 7.59355 7.69343 7.59355 10.4063H10.0486C10.0486 9.05601 11.1534 7.95122 12.5037 7.95122C13.854 7.95122 14.9588 9.05601 14.9588 10.4063C14.9588 12.8614 11.2762 12.5545 11.2762 16.544H13.7313C13.7313 13.7821 17.4139 13.4752 17.4139 10.4063C17.4139 7.69343 15.2166 5.49613 12.5037 5.49613Z" />
                    </svg>
                    <span class="ms-3">Soporte y ayuda</span>
                </x-nav-link>
            </li>

        </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
            <li>
                <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="21" height="20" viewBox="0 0 21 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5037 2.49643C11.9277 2.49643 13.0816 3.65033 13.0816 5.07428C13.0816 6.49824 11.9277 7.65213 10.5037 7.65213C9.07977 7.65213 7.92588 6.49824 7.92588 5.07428C7.92588 3.65033 9.07977 2.49643 10.5037 2.49643ZM10.5037 13.5444C14.1495 13.5444 17.9918 15.3366 17.9918 16.1222V17.4725H3.01569V16.1222C3.01569 15.3366 6.85791 13.5444 10.5037 13.5444ZM10.5037 0.164093C7.79085 0.164093 5.59354 2.3614 5.59354 5.07428C5.59354 7.78716 7.79085 9.98447 10.5037 9.98447C13.2166 9.98447 15.4139 7.78716 15.4139 5.07428C15.4139 2.3614 13.2166 0.164093 10.5037 0.164093ZM10.5037 11.212C7.22618 11.212 0.68335 12.8569 0.68335 16.1222V19.8048H20.3241V16.1222C20.3241 12.8569 13.7813 11.212 10.5037 11.212Z" />
                    </svg>
                    <span class="ms-3">{{ __('Profile') }}</span>
                </x-nav-link>
            </li>
            <li>
                <x-nav-link href="#">
                    <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="25" height="25" viewBox="0 0 25 25" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.6271 13.8862C21.6762 13.4934 21.713 13.1006 21.713 12.6832C21.713 12.2658 21.6762 11.873 21.6271 11.4802L24.2172 9.45477C24.4505 9.27063 24.5119 8.9392 24.3645 8.66914L21.9095 4.42182C21.799 4.22542 21.5903 4.11494 21.3693 4.11494C21.2957 4.11494 21.222 4.12721 21.1607 4.15176L18.1041 5.37931C17.4657 4.88829 16.7783 4.4832 16.0295 4.17632L15.563 0.923315C15.5262 0.628704 15.2684 0.407745 14.9615 0.407745H10.0514C9.74446 0.407745 9.48668 0.628704 9.44985 0.923315L8.98338 4.17632C8.23458 4.4832 7.54715 4.90057 6.90883 5.37931L3.85224 4.15176C3.77859 4.12721 3.70493 4.11494 3.63128 4.11494C3.4226 4.11494 3.21391 4.22542 3.10343 4.42182L0.64834 8.66914C0.488759 8.9392 0.562412 9.27063 0.795646 9.45477L3.38577 11.4802C3.33667 11.873 3.29984 12.2781 3.29984 12.6832C3.29984 13.0883 3.33667 13.4934 3.38577 13.8862L0.795646 15.9117C0.562412 16.0958 0.501035 16.4272 0.64834 16.6973L3.10343 20.9446C3.21391 21.141 3.4226 21.2515 3.64356 21.2515C3.71721 21.2515 3.79086 21.2392 3.85224 21.2147L6.90883 19.9871C7.54715 20.4781 8.23458 20.8832 8.98338 21.1901L9.44985 24.4431C9.48668 24.7377 9.74446 24.9587 10.0514 24.9587H14.9615C15.2684 24.9587 15.5262 24.7377 15.563 24.4431L16.0295 21.1901C16.7783 20.8832 17.4657 20.4659 18.1041 19.9871L21.1607 21.2147C21.2343 21.2392 21.308 21.2515 21.3816 21.2515C21.5903 21.2515 21.799 21.141 21.9095 20.9446L24.3645 16.6973C24.5119 16.4272 24.4505 16.0958 24.2172 15.9117L21.6271 13.8862ZM19.1966 11.7871C19.2457 12.1676 19.258 12.4254 19.258 12.6832C19.258 12.941 19.2334 13.2111 19.1966 13.5793L19.0247 14.9665L20.1172 15.8257L21.443 16.8569L20.5837 18.3422L19.0247 17.7162L17.7481 17.2006L16.6433 18.0353C16.1154 18.4281 15.6121 18.7227 15.1088 18.9314L13.8076 19.4593L13.6112 20.8464L13.3657 22.5036H11.6472L11.2175 19.4593L9.91632 18.9314C9.38848 18.7105 8.89746 18.4281 8.40644 18.0599L7.28937 17.2006L5.98817 17.7284L4.42919 18.3545L3.5699 16.8692L4.89565 15.838L5.98817 14.9787L5.81631 13.5916C5.77949 13.2111 5.75494 12.9287 5.75494 12.6832C5.75494 12.4377 5.77949 12.1554 5.81631 11.7871L5.98817 10.4L4.89565 9.54069L3.5699 8.50956L4.42919 7.02422L5.98817 7.65027L7.26482 8.16584L8.36961 7.33111C8.89746 6.9383 9.40075 6.64368 9.90404 6.435L11.2052 5.90716L11.4017 4.52003L11.6472 2.86284H13.3535L13.7831 5.90716L15.0843 6.435C15.6121 6.65596 16.1032 6.9383 16.5942 7.30656L17.7112 8.16584L19.0124 7.638L20.5714 7.01195L21.4307 8.49728L20.1172 9.54069L19.0247 10.4L19.1966 11.7871ZM12.5064 7.77303C9.79357 7.77303 7.59626 9.97034 7.59626 12.6832C7.59626 15.3961 9.79357 17.5934 12.5064 17.5934C15.2193 17.5934 17.4166 15.3961 17.4166 12.6832C17.4166 9.97034 15.2193 7.77303 12.5064 7.77303ZM12.5064 15.1383C11.1561 15.1383 10.0514 14.0335 10.0514 12.6832C10.0514 11.3329 11.1561 10.2281 12.5064 10.2281C13.8567 10.2281 14.9615 11.3329 14.9615 12.6832C14.9615 14.0335 13.8567 15.1383 12.5064 15.1383Z" />
                    </svg>
                    <span class="ms-3">Configuración</span>
                </x-nav-link>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-nav-link href="{{ route('logout') }}" click.prevent="$root.submit();">
                        <svg class="w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="23"width="23" height="23" viewBox="0 0 23 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.6415 6.46989L15.9106 8.20073L17.8502 10.1525H7.82109V12.6076H17.8502L15.9106 14.5471L17.6415 16.2903L22.5517 11.3801L17.6415 6.46989ZM2.9109 2.78725H11.5037V0.332153H2.9109C1.5606 0.332153 0.455811 1.43695 0.455811 2.78725V19.9729C0.455811 21.3232 1.5606 22.428 2.9109 22.428H11.5037V19.9729H2.9109V2.78725Z" />
                        </svg>
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
                    :class="switchOn ? 'bg-green-600' : 'bg-neutral-200'"
                    class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10">
                    <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                </button>

                <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
                       :class="{ 'text-green-600': switchOn, 'text-gray-400': ! switchOn }"
                       class="text-sm select-none">
                    Dark Mode
                </label>
            </div>
        </ul>
    </div>
</aside>

{{--<div class="p-4 sm:ml-64">
</div>--}}




<!-- sidebar -->
{{--<div class="hidden md:flex flex-col w-64 bg-white">
    <div class="flex items-center justify-center h-16 bg-white">
        <div class="text-center">
            <h3 class="text-lg color-green font-bold">Hospital Isidro Ayora</h3>
        </div>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-white">
            <x-nav-link class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-700" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" >
                <svg width="23" height="23" viewBox="0 0 23 23" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.455811 0.845459V10.6658H10.2762V0.845459H0.455811ZM7.82109 8.21074H2.9109V3.30055H7.82109V8.21074ZM0.455811 13.1209V22.9413H10.2762V13.1209H0.455811ZM7.82109 20.4862H2.9109V15.576H7.82109V20.4862ZM12.7313 0.845459V10.6658H22.5517V0.845459H12.7313ZM20.0966 8.21074H15.1864V3.30055H20.0966V8.21074ZM12.7313 13.1209V22.9413H22.5517V13.1209H12.7313ZM20.0966 20.4862H15.1864V15.576H20.0966V20.4862Z" />
                </svg>

                Dashboard
            </x-nav-link>
            <x-nav-link class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-700" href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')">
                Gestión de Usuarios
            </x-nav-link>
            <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
                Messages
            </a>
            <a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-800 hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Settings
            </a>
        </nav>
    </div>
</div>--}}
