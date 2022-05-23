<x-app-layout>
    {{-- @section('add_css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    @endsection
    @section('add_js')
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('js/objetos/main.js') }}"></script>
    @endsection --}}
    @section('add_css')
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">

        @endsection
        @section('add_js')
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        <script src="{{ asset('js/objetos/main.js') }}"></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Objetos') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-20">
                <table id="mitabla" class="display cell-border row-border border border-solid border-gray-400 rounded-md mt-4">
                    <thead class="mt-40">
                        <tr class="text-bold bg-gray-300">
                            <th class="border border-gray-400 rounded-tl-md">Nombre</th>
                            <th class="border border-gray-400">Descripción</th>
                            <th class="border border-gray-400">Replicas</th>
                            <th class="border border-gray-400">Aula</th>
                            <th class="border border-gray-400 rounded-tr-md">Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objetos as $objeto)
                        <tr>
                            <td>{{$objeto->nombre}}</td>
                            <td>{{$objeto->descripcion}}</td>
                            <td>{{$objeto->replicas}}</td>
                            <td>{{$objeto->aula}}</td>
                            <td>{{$objeto->departamento}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Replicas</th>
                            <th>Aula</th>
                            <th>Departamento</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
