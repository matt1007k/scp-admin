@extends('layouts.side-menu')

@section('head', 'Reporte por Año')

@section('subcontent')

<div class="my-5">
  <div class="pb-4 border-b border-gray-300 dark:border-slate-800">
    <h1 class="mt-2 text-xl font-medium truncate mr-5">Reporte por Año</h1>
  </div>

  <div class="grid grid-cols-12 gap-6 mt-4">

    <div class="intro-y col-span-12 lg:col-span-6">

      @livewire('reports.year')

    </div>

  </div>
</div>
@endsection
