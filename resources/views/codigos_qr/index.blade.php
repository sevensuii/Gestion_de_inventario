<x-app-layout>
    @section('add_js')
    {{-- JQuery minified --}}
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    {{-- QR code scanner --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/dynamsoft-javascript-barcode@9.0.0/dist/dbr.js"></script> --}}
    <script src="{{ asset('js/codigos_qr/html5-qrcode.min.js')}}"></script>
    <script src="{{ asset('js/codigos_qr/main.js')}}"></script>
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Escanea un QR') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden flex-1 flex-wrap shadow-xl sm:rounded-lg flex justify-center p-8">
                <div class="w-1/2 basis-full" id="reader"></div>
                <a class="p-4 bg-green-600 hover:bg-green-400 rounded-md w-2/3 mt-5 flex justify-center" href="" id="btn-redirect">
                    <button>Ir al objeto escaneado</button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
