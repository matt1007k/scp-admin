@extends('layouts.login')

@section('head', 'Registro')


@section('content')
    <div class="container sm:px-10 	">
        <div class="block max-h-max	 xl:grid grid-cols-2 gap-4 ">
            <!-- BEGIN: Register Info -->
            <div class="hidden z-10 xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        DREA
                    </span>
                </a>
                <div class="my-auto">
                    <img class="-intro-x w-1/2 -mt-16" src="{{ asset('build/assets/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign
                        up to your account.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your
                        e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen sm:mt-10 sm:pb-20 overflow-y-auto">
                <div class=" xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="  my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-4/5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Registrarse</h2>
                            <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more
                                clicks
                                to sign in to your account. Manage all your e-commerce accounts in one place</div>
                            <div class="intro-x mt-8 ">

                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 xl:mr-10">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">

                                        <x-heroicon-o-chevron-down class="lucide lucide-chevron-down w-4 h-4 mr-2" />

                                        Datos Personales
                                    </div>
                                    <div class="mt-5">
                                        <div>
                                            <label class="form-label font-medium">DNI</label>
                                            <input name="dni" type="text" maxlength="8"
                                                class=" form-control w-full border bestupper data-input-case {{ $errors->has('dni') ? ' border-danger' : '' }}"
                                                value="{{ old('dni') }}" autocomplete="off">
                                            @error('dni')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-6">
                                            <label class="form-label font-medium">Nombre</label>
                                            <input name="name" type="text"
                                                class=" form-control w-full border bestupper  {{ $errors->has('name') ? ' border-danger' : '' }}"
                                                value="{{ old('name') }}" autocomplete="off">
                                            @error('name')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-6">
                                            <label class="form-label font-medium">Apellido paterno</label>
                                            <input name="ap_paterno" type="text"
                                                class=" form-control w-full border bestupper {{ $errors->has('ap_paterno') ? ' border-danger' : '' }}"
                                                value="{{ old('ap_paterno') }}" autocomplete="off">
                                            @error('ap_paterno')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-6">
                                            <label class="form-label font-medium">Apellido materno</label>
                                            <input name="ap_materno" type="text"
                                                class=" form-control w-full border bestupper {{ $errors->has('ap_materno') ? ' border-danger' : '' }}"
                                                value="{{ old('ap_materno') }}" autocomplete="off">
                                            @error('ap_materno')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div
                                    class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 xl:mr-10 mt-6">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">

                                        <x-heroicon-o-chevron-down class="lucide lucide-chevron-down w-4 h-4 mr-2" />

                                        Datos Complementarios
                                    </div>
                                    <div class="mt-5">
                                        <fieldset x-data="{ option: null }">
                                            <legend class="font-medium">Genero</legend>
                                            <div class="mt-4 grid grid-cols-2 gap-3 ">
                                                <label for="small"
                                                    class="border dark:border-slate-200 dark:text-gray-100 rounded-md py-3 px-3 flex items-center justify-center text-sm font-medium  sm:flex-1 cursor-pointer focus:outline-none checked:bg-primary checked:border-transparent checked:text-white checked:hover:bg-blue-700"
                                                    :aria-checked="option == 'masculino'"
                                                    :class="option == 'masculino' ? 'btn btn-primary' :
                                                        'btn border-slate-300 dark:border-darkmode-400 text-slate-500 '">
                                                    <input x-model="option" id="small" type="radio" name="gender"
                                                        value="masculino" class="sr-only"
                                                        aria-labelledby="option-choice-0-label">
                                                    <p id="option-choice-0-label" class="flex items-center">

                                                        Masculino
                                                    </p>
                                                </label>

                                                <label for="medium"
                                                    class="border dark:border-slate-200  dark:text-gray-100 rounded-md py-3 px-3 flex items-center justify-center text-sm font-medium  sm:flex-1 cursor-pointer focus:outline-none checked:bg-primary checked:border-transparent checked:text-white checked:hover:bg-blue-700"
                                                    :aria-checked="option == 'femenino'"
                                                    :class="option == 'femenino' ? 'btn btn-primary' :
                                                        'btn border-slate-300 dark:border-darkmode-400 text-slate-500'">
                                                    <input x-model="option" id="medium" type="radio" name="gender"
                                                        value="femenino" class="sr-only"
                                                        aria-labelledby="option-choice-0-label">
                                                    <p id="option-choice-0-label" class="flex items-center">
                                                        Femenino

                                                    </p>
                                                </label>
                                            </div>
                                            @error('gender')
                                                <div class="text-danger  mt-2">{{ $message }}</div>
                                            @enderror
                                        </fieldset>
                                        <div class="mt-6">
                                            <label class="form-label font-medium">Fecha de Nacimiento</label>
                                            <input name="birthday" type="date" maxlength="8"
                                                class=" form-control w-full border bestupper {{ $errors->has('birthday') ? ' border-danger' : '' }}"
                                                value="{{ old('birthday') }}" autocomplete="off">
                                            @error('birthday')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-6">
                                            <label class="form-label font-medium">Celular</label>
                                            <input name="phone" type="text"
                                                class=" form-control w-full border bestupper {{ $errors->has('phone') ? ' border-danger' : '' }}"
                                                value="{{ old('phone') }}" autocomplete="off">
                                            @error('phone')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-6">
                                            <label for="office_id" class="form-label font-medium">Oficina</label>

                                            {{-- {{ $offices }} --}}
                                            <select id="office_id" name="office_id"
                                                class="form-select  block w-full pl-3  py-2" required>

                                                @foreach ($offices as $office)
                                                    <option value="{{ $office->id }}"
                                                        {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                                        {{ $office->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 xl:mr-10 mt-6">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">

                                        <x-heroicon-o-chevron-down class="lucide lucide-chevron-down w-4 h-4 mr-2" />

                                        Correo Eléctronico
                                    </div>
                                    <div class="mt-5">
                                        <div class="mt-6">
                                            <label class="form-label font-medium">Correo</label>
                                            <input name="email" type="email"
                                                class=" form-control w-full border bestupper {{ $errors->has('email') ? ' border-danger' : '' }}"
                                                value="{{ old('email') }}" autocomplete="off">
                                            @error('email')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-6">
                                            <label class="form-label font-medium">Contraseña</label>
                                            <input name="password" type="password"
                                                class=" form-control w-full border bestupper {{ $errors->has('password') ? ' border-danger' : '' }}"
                                                value="{{ old('password') }}" autocomplete="off">
                                            @error('password')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-6">
                                            <label class="form-label font-medium">Confirma contraseña</label>
                                            <input name="password_confirmation" type="password"
                                                class=" form-control w-full border bestupper {{ $errors->has('password') ? ' border-danger' : '' }}"
                                                value="{{ old('password_confirmation') }}" autocomplete="off">
                                            @error('password_confirmation')
                                                <div class="login__input-error  text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>





                            </div>

                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left xl:space-x-4 ">
                                <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-40 xl:mr-3 align-top">
                                    <x-heroicon-o-rocket-launch class="lucide lucide-rocket-lñaunch w-4 h-4 mr-2" />
                                    Registrarse
                                </button>
                                <a href="{{ route('login') }}"
                                    class="btn btn-outline-secondary py-3 px-4 w-full xl:w-52 mt-6 xl:mt-0 align-top">
                                    ¿Ya tienes una cuenta?</a>


                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- END: Register Form -->
        </div>
    </div>
@endsection
