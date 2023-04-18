@extends('layouts.side-menu')

@section('head', 'Editar Persona')

@section('subcontent')

<div class="my-5">
  <div class="pb-4 border-b border-gray-300 dark:border-slate-800">
    <div>
      <a href="{{ route('people.index') }}" class="flex w-auto text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white">
        <x-feathericon-arrow-left class="w-5 h-5 mr-1" />
        Volver
      </a>
    </div>
    <h1 class="mt-2 text-xl font-medium truncate mr-5">Editar Persona</h1>
  </div>

  <div class="grid grid-cols-12 gap-6 mt-4">

    <div class="intro-y col-span-12 lg:col-span-6">

      {!! Form::model($person, ['route' => ['people.update', $person->id], 'method' => 'PUT']) !!}
      @include('admin.people.partials.form', ['btnText' => 'Editar'])
      {!! Form::close() !!}

    </div>

  </div>
</div>
@endsection
