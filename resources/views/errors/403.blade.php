@extends('layouts.main')

@section('head', 'Error 403')


@section('content')
    <div class="container">
        <!-- BEGIN: Error Page -->
        <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
            <div class="-intro-x lg:mr-20">
                <img alt="Error 403" class="h-48 lg:h-auto" src="{{ asset('build/assets/images/error-illustration.svg') }}">
            </div>
            <div class="text-white mt-10 lg:mt-0">
                <div class="intro-x text-8xl font-medium">403</div>
                <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Sin autorización</div>
                <div class="intro-x text-lg mt-3">No tienes los permisos para acceder a esta página.</div>
                <a href="{{ route('dashboard') }}"
                    class="intro-x btn py-3 px-4 text-white border-white dark:border-dark-5 dark:text-gray-300 mt-10">Regresar
                    a Inicio</a>
            </div>
        </div>
        <!-- END: Error Page -->
    </div>
@endsection
