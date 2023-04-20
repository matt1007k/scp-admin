@extends('layouts.login')

@section('head', 'Iniciar Sesión')

@section('content')
    <div class="relative h-screen w-full bg-gradient-to-r from-sky-500 to-indigo-500 p-0">

        <div class="z-10 w-full h-full"
            style="background-image: url({{ asset('build/assets/images/logos/logo-drea.png') }}); background-repeat: no-repeat; background-position: center center; background-size: cover; opacity: 5%;">
        </div>
        <div
            class="absolute inset-0 z-50 isolate w-full h-full flex flex-col  justify-start items-center md:justify-center px-5 sm:px-0">
            <img class="w-28" src="{{ asset('build/assets/images/logos/payment-card.png') }}" alt="Payment Card">
            <h2 class="text-2xl md:text-4xl font-bold w-full md:w-[500px] text-center text-white">SISTEMA DE GESTIÓN DE
                CONSTANCIAS DE PAGO</h2>
            <p class="text-lg text-gray-200 text-center">Gestiona los procesos en la entrega de constancias de pago</p>
            <div class="bg-white dark:bg-slate-700 px-6 md:px-10 py-12 rounded-2xl mt-6 w-full md:w-[500px]">
                <form method="POST" action="{{ route('login') }}">
                    <h2 class="intro-x font-bold text-xl sm:text-2xl xl:text-3xl text-center ">Ingresar para continuar</h2>

                    <div class="intro-x mt-8">

                        @csrf

                        <label class="form-label font-medium">DNI</label>
                        <input name="dni" type="text"
                            class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                            value="{{ old('dni') }}">

                        @error('dni')
                            <div class="login__input-error w-5/6 text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="form-label font-medium mt-5">Contraseña</label>
                        <input name="password" type="password"
                            class="intro-x login__input form-control py-3 px-4 border-gray-300 block ">

                        @error('password')
                            <div class="login__input-error w-5/6 text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="remember-me" type="checkbox" name="remember" class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">Recuerdame</label>
                        </div>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:mr-3 align-top">Iniciar
                            Sesión</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
