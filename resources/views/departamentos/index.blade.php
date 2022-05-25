<x-app-layout>
    @section('add_css')
        {{-- Datatable css --}}
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
        {{-- Fomantic ui --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.css">
    @endsection
    @section('add_js')
        {{-- JQuery minified --}}
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        {{-- Datatable --}}
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        {{-- Js objetos --}}
        <script src="{{ asset('js/departamentos/main.js') }}"></script>
        {{-- Sweet alert 2 --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Fomantic ui --}}
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi departamento: ') }}{{$departamento->nombre}}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                <table id="mitabla" class="display cell-border row-border border border-solid border-gray-400 rounded-md mt-4">
                    <thead class="mt-40">
                        <tr class="text-bold bg-gray-300">
                            <th class="border border-gray-400 rounded-tl-md"></th>
                            <th class="border border-gray-400">Nombre</th>
                            <th class="border border-gray-400">Descripción</th>
                            <th class="border border-gray-400">Replicas</th>
                            <th class="border border-gray-400">Aula</th>
                            <th class="border border-gray-400 rounded-tr-md">Departamento</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objetos as $objeto)
                        <tr data-aula-id="{{$objeto->id_aula}}" data-objeto-id="{{$objeto->id}}">
                            <th><i class="gg-image m-auto cursor-pointer" title="Mostrar réplicas"></i></th>
                            <td>{{$objeto->nombre}}</td>
                            <td>{{$objeto->descripcion}}</td>
                            <td class="replicas cursor-pointer">{{$objeto->replicas}}</td>
                            <td class="aulas cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">{{$objeto->aula}}</td>
                            <td class="departamentos cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">{{$objeto->departamento}}</td>
                            <td><i class="gg-pen cursor-pointer" title="Editar"></i></td>
                            <td><i class="gg-trash cursor-pointer delete-item" title="Eliminar"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Replicas</th>
                            <th>Aula</th>
                            <th>Departamento</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div class="ui modal longer">
        <div id="modal-tittle" class="header">Header</div>
        <div id="modal-data" class="scrolling content">
            <table id="modal-table" class="ui celled striped table">

            </table>
        </div>
        <div class="actions">
            <div class="ui cancel button">Cerrar</div>
        </div>
    </div>
    {{-- End modal --}}
    {{-- Loader --}}
    <div id="loader" class="ui huge centered inline loader double red" style="position: fixed; top:50%; left:50%"></div>
    {{-- End loader --}}
</x-app-layout>
