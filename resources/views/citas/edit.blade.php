<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <form action="{{ route('citas.update', $cita->idcita) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-label for="medico_horario_idmedico_horario" value="{{ __('Select Doctor Schedule') }}" />
                        <select id="medico_horario_idmedico_horario" name="medico_horario_idmedico_horario" class="block mt-1 w-full">
                            @foreach ($medicosHorarios as $medicoHorario)
                                <option value="{{ $medicoHorario->idmedico_horario }}" {{ $cita->medico_horario_idmedico_horario == $medicoHorario->idmedico_horario ? 'selected' : '' }}>{{ $medicoHorario->especialidad->nombre }} - {{ $medicoHorario->horario->rango_horario }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="medico_horario_idmedico_horario" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="usuario_rol_idusuario_rol" value="{{ __('Select Patient Role') }}" />
                        <select id="usuario_rol_idusuario_rol" name="usuario_rol_idusuario_rol" class="block mt-1 w-full">
                            @foreach ($usuariosRoles as $usuarioRol)
                                <option value="{{ $usuarioRol->idusuario_rol }}" {{ $cita->usuario_rol_idusuario_rol == $usuarioRol->idusuario_rol ? 'selected' : '' }}>{{ $usuarioRol->usuario->nombres }} {{ $usuarioRol->usuario->apellidos }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="usuario_rol_idusuario_rol" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-label for="fecha_atencion" value="{{ __('Appointment Date and Time') }}" />
                        <x-input id="fecha_atencion" class="block mt-1 w-full" type="datetime-local" name="fecha_atencion" value="{{ $cita->fecha_atencion }}" required />
                        <x-input-error for="fecha_atencion" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update Appointment') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
