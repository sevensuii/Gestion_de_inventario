<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($objeto) ? "Objeto: $objeto->nombre" : 'Nuevo objeto' }}
            {{-- @if (isset($objeto))
                {{ __('Objeto: ') }} {{ $objeto->nombre }}
            @else
                {{ __('Nuevo objeto') }}
            @endif --}}
        </h2>
        @section('add_css')
            {{-- Quill editor styles --}}
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
            {{-- Estilos para la subida de imagen --}}
            <link rel="stylesheet" href="{{asset('css/departamentos/subidaImagen.css')}}">
        @endsection
        @section('add_js')
            {{-- JQuery minified --}}
            <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
            {{-- Sweet alert 2 --}}
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            {{-- Quill text editor --}}
            <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
            {{-- Create objetos en departamento --}}
            <script src="{{asset('js/departamentos/create.js ')}}"></script>

        @endsection
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="POST" class="flex flex-col md:flex-row flex-wrap">
                    {{-- Imagen --}}
                    <div class="basis-1/3">
                        <img class="h-64 rounded-md md:w-full mx-auto" src="{{ asset('/storage/default/default_image.jpg')}}" alt="Imagen del objeto">
                        <div class="image-input p-2 border border-black rounded-md m-2">
                            <input type="file" accept="image/*" id="imageInput">
                            <label for="imageInput" class="image-button cursor-pointer "><i class="gg-image"></i> {{ isset($objeto->objeto_photo_path) ? 'Elige una nueva imagen' : 'Elige una imagen'}}</label>
                            <img src="" class="image-preview m-auto rounded-md">
                            <span class="change-image cursor-pointer border border-blue-500 rounded-md p-2 mt-1 hover:bg-blue-400">¿Prefieres otra imagen?</span>
                        </div>
                    </div>
                    {{-- Campos del objeto --}}
                    <div class="p-10 basis-2/3">
                        <div class="mb-4">
                            <label for="nombre">Nombre</label><br>
                            <input class="w-full rounded-md max-w-[720px]" type="text" name="nombre" id="nombre" placeholder="Hola mundo" :value="old('nombre')"><br>
                        </div>
                        <div>
                            <label for="descripcion">Descripción</label><br>
                            <input class="hidden" type="text" name="descripcion" id="descripcion" value="hola" :value="old('descripcion')">
                            <div class="h-64 min-h-[10rem] rounded-b-md max-w-[720px]" id="descripcion-editor" ></div><br>
                        </div>
                    </div>
                    {{-- Botones --}}
                    <div class="flex justify-between basis-full p-10 items-center">
                        <div class="custom-number-input h-10 w-32 ">
                            <div class="custom-number-input h-10 w-32">
                                <label for="custom-input-number" class="w-full text-gray-700 text-sm font-semibold">Counter Input
                                </label>
                                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                  <button data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                  </button>
                                  <input type="number" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="1"></input>
                                    <button data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit">{{ isset($objeto) ? 'Actualizar' : 'Crear'}}</button>
                            <a href="{{route('midepartamento')}}">
                                <button type="reset">Cancelar</button>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
