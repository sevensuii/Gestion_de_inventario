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
        <script src="{{ asset('js/objetos/main.js') }}"></script>
        {{-- Sweet alert 2 --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Fomantic ui --}}
        <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.8/dist/semantic.min.js"></script>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Objetos') }}
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objetos as $objeto)
                        <tr data-aula-id="{{$objeto->id_aula}}" data-departamento-id="{{$objeto->id_departamento}}" data-imagen-url="{{$objeto->objeto_photo_path}}">
                            <th><i class="gg-image m-auto cursor-pointer imagen-show" title="Mostrar imagen"></i></th>
                            <td>{{$objeto->nombre}}</td>
                            <td>{{$objeto->descripcion}}</td>
                            <td>{{$objeto->replicas}}</td>
                            <td class="aulas cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">{{$objeto->aula}}</td>
                            <td class="departamentos cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">{{$objeto->departamento}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-bold bg-gray-300">
                            <th class="border border-gray-400"></th>
                            <th class="border border-gray-400">Nombre</th>
                            <th class="border border-gray-400">Descripción</th>
                            <th class="border border-gray-400">Replicas</th>
                            <th class="border border-gray-400">Aula</th>
                            <th class="border border-gray-400">Departamento</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="">
        {{-- <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
          Vertically centered modal
        </button> --}}
        {{-- <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
          Vertically centered scrollable modal
        </button> --}}
      </div>

      {{-- Modal --}}
      {{-- <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
          <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
              <h5 id="modal-tittle" class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel"> --}}
                {{-- Modal title --}}
              {{-- </h5>
              <button type="button"
                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body relative p-4">
                <table id="modal-table" class="display cell-border row-border border border-solid border-gray-400 rounded-md mt-4">

                </table>
            </div>
            <div
              class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
              <button type="button"
                class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                data-bs-dismiss="modal">
                Cerrar
              </button> --}}
              {{-- <button type="button"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                Save changes
              </button> --}}
            {{-- </div>
          </div>
        </div>
      </div> --}}

      <!--<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollable" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable relative w-auto pointer-events-none">
          <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
              <h5 id="modal-tittle" class="text-xl font-medium leading-normal text-gray-800" id="exampleModalCenteredScrollableLabel">
                {{-- AQUI VA EL TITULO DEL MODAL --}}
              </h5>
              <button type="button"
                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-data" class="modal-body relative p-4">
              {{-- AQUI VA EL TEXTO --}}
              <table id="modal-table" class="display cell-border row-border border border-solid border-gray-400 rounded-md mt-4">

              </table>
            </div>
            <div
              class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
              <button type="button"
                class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                data-bs-dismiss="modal">
                Cerrar
              </button>
              {{-- <button type="button"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                Save changes
              </button> --}}
            </div>
          </div>
        </div>
      </div>-->

    <div id="modal-table-show" class="ui modal longer">
        <div id="modal-tittle" class="header">Header</div>
        <div id="modal-data" class="scrolling content">
            <table id="modal-table" class="ui celled striped table">

            </table>
        </div>
        <div class="actions">
            <div class="ui cancel button">Cerrar</div>
        </div>
    </div>
    {{-- modal imagenes --}}
    <div id="modal-img" class="ui modal longer">
        <div id="imagen-tittle" class="header">Imagen</div>
        <div id="imagen-data" class="scrolling content">
            <img id="imagen-show" class="lg:full" alt="Imagen del objeto">
            <div id="img-error" class="ui error message">
                <i class="close icon"></i>
                <div class="header">
                  Ha ocurrido algún error
                </div>
                <ul class="list">
                  <li>La URL de la imagen es incorrecta</li>
                  <li>La imagen a la que intenta acceder puede haber sido borrada</li>
                </ul>
              </div>
        </div>
        <div class="actions">
            <div class="ui cancel button">Cerrar</div>
        </div>
    </div>
      {{-- End modal --}}
</x-app-layout>
