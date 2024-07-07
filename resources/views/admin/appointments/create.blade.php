<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-800 leading-tight dark:text-white">
            {{ __('Create New Appointment') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-label for="medic_schedule_id_medic_schedule" value="{{ __('Select Doctor Schedule') }}" />
                        <select id="medic_schedule_id_medic_schedule" name="medic_schedule_id_medic_schedule" class="block mt-1 w-full">
                            @foreach ($medicosHorarios as $medicSchedule)
                                <option value="{{ $medicSchedule->id_medic_schedule }}">{{ $medicSchedule->specialty->name }} - {{ $medicSchedule->schedule->time_range }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="medic_schedule_id_medic_schedule" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="usuario_rol_idusuario_rol" value="{{ __('Select Patient Role') }}" />
                        <select id="usuario_rol_idusuario_rol" name="usuario_rol_idusuario_rol" class="block mt-1 w-full">
                            @foreach ($usuariosRoles as $usuarioRol)
                                <option value="{{ $usuarioRol->idusuario_rol }}">{{ $usuarioRol->usuario->first_name }} {{ $usuarioRol->usuario->last_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="usuario_rol_idusuario_rol" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="service_date" value="{{ __('Appointment Date and Time') }}" />
                        <x-input id="service_date" class="block mt-1 w-full" type="datetime-local" name="service_date" :value="old('service_date')" required />
                        <x-input-error for="service_date" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Create Appointment') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
