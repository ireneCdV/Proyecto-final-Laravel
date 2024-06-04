<x-app-layout>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pedido Realizado con Éxito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Tu pedido ha sido realizado con éxito. ¡Gracias por tu compra!</p>
                    <br>
                    <a href="{{ route('dashboard') }}" class="button-gold py-2 px-4 mt-2">
                        Ir al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
