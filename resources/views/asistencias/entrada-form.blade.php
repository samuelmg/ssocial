@extends('layouts.windmill')
@section('contenido')
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Formulario de Programa
    </h4>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @include('partials.form-errors')

        <form action="{{ route('asistencia.formEntrada') }}" method="GET">
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Seleccione Programa
                </span>

                <select
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    name="programa_id"
                >
                    <option value=''>---</option>
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                    @endforeach
                </select>
            </label>
            <div class="mt-4">
                <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    type="submit"
                >
                  <span>Seleccionar Programa</span>
                </button>
            </div>

        </form>
        <br>
        <hr>

        @if(!empty($programa_id))
            <form action="{{ route('asistencia.registrarEntrada') }}" method="POST">
                @csrf

                <input type="hidden" name="programa_id" value={{ $programa_id }}>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                    Seleccione Prestador
                    </span>

                    <select
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        name="prestador_id"
                    >
                        @foreach ($prestadores as $prestador)
                            <option value="{{ $prestador->id }}">{{ $prestador->nombre }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="mt-4">
                    <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        type="submit"
                    >
                        <svg class="w-6 h-6 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                    <span>Registrar Entrada</span>
                    </button>
                </div>

            </form>
        @endif
    </div>
@endsection
