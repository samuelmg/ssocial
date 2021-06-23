@extends('layouts.windmill')
@section('contenido')

<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Registrar Salida
</h2>

<div class="w-full overflow-hidden rounded-lg shadow-xs">
<div class="w-full overflow-x-auto">
  <table class="w-full whitespace-no-wrap">
    <thead>
      <tr
        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
      >
        <th class="px-4 py-3">Prestador</th>
        <th class="px-4 py-3">Programa</th>
        <th class="px-4 py-3">Fecha</th>
        <th class="px-4 py-3">Entrada</th>
        <th class="px-4 py-3">Acciones</th>
      </tr>
    </thead>
    <tbody
      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
    >
    @foreach ($asistencias as $asistencia)

      <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3">
          <div class="flex items-center text-sm">
            {{ $asistencia->prestador->nombre }}</a>
          </div>
        </td>
        <td class="px-4 py-3">
            <div class="flex items-center text-sm">
              {{ $asistencia->programa->nombre }}</a>
            </div>
          </td>
        <td class="px-4 py-3 text-sm">
            {{ $asistencia->fecha }}
        </td>
        <td class="px-4 py-3 text-xs">
            {{ $asistencia->entrada }}
        </td>

        <td class="px-4 py-3">
          <div class="flex items-center space-x-4 text-sm">
            <form action="{{ route('asistencia.registrarSalida', $asistencia) }}" method="POST">
                @csrf

                <button
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Registrar Salida"
                >
                    Registrar Salida
                </button>
            </form>
          </div>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection
