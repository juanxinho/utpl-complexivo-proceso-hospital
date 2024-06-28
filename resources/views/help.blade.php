<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Help and Support') }}
        </h2>
    </x-slot>

    <div class="py-2 md:py-12">
        <div class="mx-auto sm:px-6 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900 dark:text-gray-500 p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-malachite-300">Bienvenido a la página de Soporte y Ayuda</h3>
                <p class="mt-4 text-gray-600">
                    Aquí puedes encontrar información útil para resolver tus dudas y obtener soporte técnico.
                </p>

                <div class="mt-6">
                    <h4 class="text-md font-semibold text-gray-800">Preguntas Frecuentes</h4>
                    <ul class="list-disc list-inside mt-2 text-gray-600">
                        <li>¿Cómo puedo crear una cuenta?</li>
                        <li>¿Cómo puedo restablecer mi contraseña?</li>
                        <li>¿Cómo puedo contactar con soporte técnico?</li>
                    </ul>
                </div>

                <div class="mt-6">
                    <h4 class="text-md font-semibold text-gray-800">Contactar con Soporte</h4>
                    <p class="mt-2 text-gray-600">
                        Si necesitas ayuda adicional, puedes contactar con nuestro equipo de soporte técnico enviando un correo a <a href="mailto:soporte@example.com" class="text-malachite-600 dark:text-malachite-300">soporte@example.com</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
