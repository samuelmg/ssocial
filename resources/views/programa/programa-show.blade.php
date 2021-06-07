@extends('layouts.windmill')
@section('contenido')

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Detalle de programa
</h2>

<div class="grid gap-6 mb-8 md:grid-cols-2">
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
      <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
        {{ $programa->nombre }}
      </h4>
      <p class="text-gray-600 dark:text-gray-400">
        <ul>
            <li>Dependencia: {{ $programa->dependencia }}</li>
            <li>Calendario: {{ $programa->calendario }}</li>
            <li>Titular: {{ $programa->titular }}</li>
            <li>Folio: {{ $programa->folio }}</li>
        </ul>
      </p>
    </div>

</div>

    <form action="{{ route('programa.destroy', $programa) }}" method="POST">
        @csrf
        @method('DELETE')

        <div>
            <button
                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Eliminar Programa</span>
            </button>
        </div>
    </form>

@endsection
