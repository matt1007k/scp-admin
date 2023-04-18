@extends('layouts.side-menu')

@section('head', 'Actualizar Perfil')

@section('subcontent')

    <div class="container px-6 mx-auto grid">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Profile Information
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Update your account's profile information and email address.
                        </p>
                    </header>
                    <form method="post" action="http://10.15.1.250:8000/profile" class="mt-6 space-y-6">
                        <div>
                            <label class="form-label font-medium">DNI</label>
                            {{ Form::text('dni', null, ['autofocus' => 'true', 'class' => 'form-control  w-full border bestupper' . ($errors->has('dni') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

                            @error('dni')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="flex items-center gap-4">

                            <button type="submit" class="btn btn-primary">
                                <x-feathericon-check-square class="w-4 h-4 mr-2" />
                                Guardar
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>


    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Actualizar datos de perfil</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-dark w-24 ml-auto shadow-md mr-2">
            <x-feathericon-arrow-left class="w-5 h-5 mr-1" />
            Volver
        </a>
    </div>


    <div class="grid grid-cols-8 gap-6 mt-5">
        <div class="intro-y col-span-8 lg:col-span-3 ">
            <div class="intro-y box mt-5 lg:mt-0">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Perfil" class="rounded-full" src="{{ $user->profile_photo }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ $user->full_name_formal }}</div>
                        <div class="text-slate-500">{{ $user->dni }}</div>
                    </div>

                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <span class="flex items-center text-primarylight font-medium">
                        <x-heroicon-o-bars-3-bottom-left class="w-4 h-4 mr-2" />
                        Detalles
                    </span>
                    <span class="flex items-center mt-5">
                        {{-- <x-heroicon-o-building-office class="w-4 h-4 mr-2" /> {{ $user->office->name }} --}}
                    </span>

                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center underline decoration-dotted " href="#update-info">
                        <x-heroicon-o-identification class="w-4 h-4 mr-2" /> Actualizar Información Personal
                    </a>
                    <a class="flex items-center underline decoration-dotted  mt-5" href="#update-password">
                        <x-heroicon-o-key class="w-4 h-4 mr-2" /> Actualizar Contraseña
                    </a>

                </div>


            </div>
        </div>

        <div class="intro-y col-span-8 lg:col-span-5">



            <div id="update-info" class="intro-y box ">


                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Actualizar Información Personal</h2>
                </div>


                <div class="p-5 lg:p-6 grow w-full md:flex md:space-x-5">
                    <p class="md:flex-none md:w-1/3 text-gray-500 text-sm mb-5 dark:text-slate-300">
                        Actualiza tus datos personales en caso de ser necesario.
                    </p>

                    {{-- {!! Form::model($user, ['route' => ['account-setting.updatePassword', $user], 'method' => 'PUT']) !!}
                    @include('profile.partials.personal-info')

                    <div class="flex justify-start mt-5">
                        <button type="submit" class="btn btn-primary">
                            <x-feathericon-check-square class="w-4 h-4 mr-2" />
                            Guardar
                        </button>

                    </div>
                    {!! Form::close() !!} --}}
                </div>


            </div>

            <!-- BEGIN: Personal Information -->
            <div id="update-password" class="intro-y box mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Actualizar Contraseña</h2>
                </div>
                <div class="p-5 lg:p-6 grow w-full md:flex md:space-x-5">
                    <p class="md:flex-none md:w-1/3 text-gray-500  dark:text-slate-300 text-sm mb-5">
                        Cambiar su contraseña de inicio de sesión es una manera fácil de mantener su cuenta segura.
                    </p>

                    {{-- {!! Form::model($user, ['route' => ['account-setting.updatePassword', $user], 'method' => 'PUT']) !!}
                    @include('profile.partials.password')

                    <div class="flex justify-start mt-5">
                        <button type="submit" class="btn btn-primary">
                            <x-feathericon-check-square class="w-4 h-4 mr-2" />
                            Guardar
                        </button>

                    </div>
                    {!! Form::close() !!} --}}
                </div>

            </div>
            <!-- END: Personal Information -->
        </div>

    </div>


@endsection
