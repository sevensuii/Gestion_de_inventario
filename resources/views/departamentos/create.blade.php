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
            {{-- Fomantic ui --}}
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
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
            {{-- Fomantic ui --}}
            <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
            {{-- QR generator --}}
            <script src="{{ asset('js/codigos_qr/qrcode-gen.min.js')}}"></script>

        @endsection
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" class="flex flex-col md:flex-row flex-wrap" enctype="multipart/form-data">
                    @csrf
                    {{-- Imagen --}}
                    <div class="basis-1/3">
                        <img class="h-64 rounded-md md:w-full mx-auto" src="{{ isset($objeto->objeto_photo_path) ? asset('storage').'/'.$objeto->objeto_photo_path : asset('/storage/default/default_image.jpg')}}" alt="Imagen del objeto">
                        {{-- <div class="image-input p-2 border border-black rounded-md m-2">
                            <input type="file" accept=".jpg,.jpeg,.png,.gif" id="imageInput">
                            <label for="imageInput" class="image-button cursor-pointer "><i class="gg-image"></i> {{ isset($objeto->objeto_photo_path) ? 'Elige una nueva imagen' : 'Elige una imagen'}}</label>
                            <img src="" class="image-preview m-auto rounded-md">
                            <span class="change-image cursor-pointer border border-blue-500 rounded-md p-2 mt-1 hover:bg-blue-400">¿Prefieres otra imagen?</span>
                        </div> --}}
                        <input class="ml-4 mt-4" type="file" name="foto" id="foto">
                    </div>
                    {{-- Campos del objeto --}}
                    <div class="p-10 basis-2/3">
                        <x-jet-validation-errors class="mb-4" />
                        <div class="mb-4">
                            <label for="nombre">Nombre</label><br>
                            <input class="w-full rounded-md max-w-[720px]" type="text" name="nombre" id="nombre" placeholder="Hola mundo" value="{{$objeto->nombre ?? ''}}" :value="old('nombre')"><br>
                            <input class="hidden" type="number" name="item_id" id="item_id" value="{{$objeto->id ?? ''}}">
                            <div class="ui right labeled input mt-5">
                                <select name="aula" id="aula" class="ui selection dropdown">
                                  @foreach ($aulas as $aula)
                                    <option value="{{ $aula->id }}" @if( isset($objeto)) {{ $aula->id === $objeto->id_aula ? 'selected' : ''}} @endif>{{ $aula->nombre }}</option>
                                  @endforeach
                                </select>
                                <div class="ui basic label">Aula</div>
                              </div>
                        </div>
                        <div>
                            <label for="descripcion">Descripción</label><br>
                            <input class="hidden" type="text" name="descripcion" id="descripcion" value="{{ $objeto->descripcion ?? ''}}" :value="old('descripcion')">
                            <div class="h-64 min-h-[10rem] rounded-b-md max-w-[720px]" id="descripcion-editor" ></div><br>
                        </div>
                    </div>
                    {{-- Botones --}}
                    <div class="flex md:justify-between flex-wrap basis-full p-10 items-center justify-center">
                        <div class="custom-number-input h-10 flex">
                            <div class="custom-number-input h-10 w-32">
                                <label for="custom-input-number" class="w-full text-gray-700 text-sm font-semibold">
                                </label>
                                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                  <button data-action="decrement" class="prevent-default bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                  </button>
                                  <input type="number" id='cantidad' class="focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="replicas" value="1" min="1"></input>
                                    <button data-action="increment" class="prevent-default bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div>
                                {{-- <input class="w-14 mt-2" type="number" name="replicas" id="replica"> --}}
                            <button id="generar" class="ui black button prevent-default">Generar</button>
                        </div>
                        <div class="mt-8">
                            <button id='submitBtn' {{ isset($objeto) ? 'data-guardado=true' : 'data-guardado=false'}} class="bg-green-600 rounded-md text-white font-bold p-3 px-5 mr-2 hover:bg-green-500" type="submit">{{ isset($objeto) ? 'Actualizar' : 'Crear'}}</button>
                            <a class="bg-red-600 rounded-md text-white hover:text-white font-bold p-3 px-5 hover:bg-red-500" href="{{route('midepartamento')}}">
                                Cancelar
                            </a>
                        </div>

                    </div>
                </form>
            </div>
            @if (isset($objeto))
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-8 p-8">
                    <table class="ui celled striped table rounded-md">
                        <thead>
                            <tr>
                                <th>QR</th>
                                <th>Código QR</th>
                                <th>Incidencias</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($replicas as $replica)
                                <tr data-qr="{{ $replica->codigo_qr}}" data-id="{{ $replica->id_replica}}">
                                    <td class="qrcode" data-qr="{{ $replica->codigo_qr}}"><i class="fa-solid fa-qrcode mx-auto cursor-pointer"></i></td>
                                    <td class="qrcode-val">{{ $replica->codigo_qr}}</td>
                                    <td class="incidencias"><div class="incidencias-editor rounded-b-md">{!! $replica->incidencias!!}</div></td>
                                    <td class="guardar"><i class="gg-check-o mx-auto cursor-pointer hover:text-green-600" title="Guardar"></i></td>
                                    <td class="borrar"><i class="gg-trash hover:text-red-600 mx-auto cursor-pointer" title="Eliminar"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>QR</th>
                                <th>Código QR</th>
                                <th class="font-bold">Incidencias</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            @endif
        </div>
    </div>
    {{-- Loader --}}
    <div id="loader" class="ui huge centered inline loader double red" style="position: fixed; top:50%; left:50%"></div>
    {{-- Modal qr --}}
    <div id="modal-img" class="ui modal longer">
        <div id="imagen-tittle" class="header">Imagen</div>
        <div id="imagen-data" class="scrolling content">
            <div id="qrcode"></div>
        </div>
        <div class="actions">
            <div class="ui cancel button">Cerrar</div>
        </div>
    </div>
</x-app-layout>
