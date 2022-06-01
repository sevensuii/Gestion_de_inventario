<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Objeto: ') }} {{$objeto[0]->nombre}}
        </h2>
        @section('add_css')
            {{-- Quill editor styles --}}
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
            {{-- Fomantic ui --}}
            <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
            {{-- QR generator --}}
            <script src="{{ asset('js/codigos_qr/qrcode-gen.min.js')}}"></script>
            {{-- Show objetos --}}
            <script src="{{asset('js/objetos/show.js ')}}"></script>
        @endsection
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col md:flex-row flex-wrap">
                    {{-- Imagen --}}
                    <div class="basis-1/3">
                        <img class="h-64 rounded-md md:w-full mx-auto" src="{{ isset($objeto[0]->objeto_photo_path) ? asset('storage').'/'.$objeto[0]->objeto_photo_path : asset('/storage/default/default_image.jpg')}}" alt="Imagen del objeto">
                        <div class="flex justify-center m-2">
                            <div id="qrcode" class="w-32"></div>
                        </div>
                        <span id="qrcode-val" class="flex justify-center bg-black border-2 border-blue-600 mx-auto w-2/3 text-white p-3 rounded-md md:w-full">{{ $objeto[0]->codigo_qr ?? ''}}</span>
                    </div>
                    {{-- Campos del objeto --}}
                    <div class="p-10 basis-2/3">
                        <x-jet-validation-errors class="mb-4" />
                        <div class="mb-4">
                            <label for="nombre">Nombre</label><br>
                            <input class="w-full rounded-md max-w-[720px]" type="text" name="nombre" id="nombre" placeholder="Hola mundo" value="{{$objeto[0]->nombre ?? ''}}" disabled><br>
                            <input class="hidden" type="number" name="item_id" id="item_id" value="{{$objeto[0]->id ?? ''}}">
                            <div class="ui right labeled input mt-5">
                                <select name="aula" id="aula" class="ui selection dropdown" disabled>
                                    <option>{{ $objeto[0]->aula ?? ''}}</option>
                                </select>
                                <div class="ui basic label">Aula</div>
                            </div>
                            <div class="ui right labeled input mt-5">
                                <select name="aula" id="aula" class="ui selection dropdown" disabled>
                                    <option>{{ $objeto[0]->dep ?? ''}}</option>
                                </select>
                                <div class="ui basic label">Departamento</div>
                            </div>
                        </div>
                        <div>
                            <label for="descripcion">Descripción</label><br>
                            <input class="hidden" type="text" name="descripcion" id="descripcion" value="{{ $objeto[0]->descripcion ?? ''}}">
                            <div class="h-64 min-h-[10rem] rounded-md max-w-[720px]" id="descripcion-editor" ></div><br>
                        </div>
                        <div>
                            <label for="incidencias">Incidencias</label><br>
                            <div class="h-64 min-h-[10rem] rounded-md max-w-[720px]" id="incidencias-editor" >{{ $objeto[0]->incidencias ?? ''}}</div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
