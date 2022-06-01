<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="flex justify-center mt-4 text-blue-500 text-2xl">¿Qué apetece hacer?</h2>
                <div class="flex p-20 justify-around flex-wrap md:justify-center">
                    <a href="{{ route('objetos')}}">
                        <div class="border-2 border-blue-400 rounded-lg p-3 hover:bg-blue-400 hover:text-white cursor-pointer m-4">
                            <div class="text-7xl flex justify-center">
                                <i class="fa-brands fa-searchengin"></i>
                            </div>
                            <div class="text-xl m-4 flex justify-center">Busca un objeto</div>
                        </div>
                    </a>
                    <a href="{{route('escanear')}}">
                        <div class="border-2 border-blue-400 rounded-lg p-3 hover:bg-blue-400 hover:text-white cursor-pointer m-4">
                            <div class="text-7xl flex justify-center">
                                <i class="fa-solid fa-qrcode"></i>
                            </div>
                            <div class="text-xl m-4 flex justify-center">Escanea un QR</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
