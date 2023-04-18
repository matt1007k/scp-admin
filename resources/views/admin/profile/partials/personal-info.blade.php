<div>

    <div>
        <label class="form-label font-medium">DNI</label>
        {{ Form::text('dni', null, ['autofocus' => 'true', 'class' => 'form-control  w-full border bestupper' . ($errors->has('dni') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('dni')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mt-6">
        <label class="form-label font-medium">Nombre</label>
        {{ Form::text('name', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('name') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('name')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mt-6">
        <label class="form-label font-medium">Apellido Paterno</label>
        {{ Form::text('ap_paterno', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('ap_paterno') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('ap_paterno')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-6">
        <label class="form-label font-medium">Apellido Materno</label>
        {{ Form::text('ap_materno', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('ap_materno') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('ap_materno')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-6">
        <label class="form-label font-medium">Genero</label>

        <ul class="grid grid-cols-2 gap-3 ">
            <li class="relative">
                {{ Form::radio('gender', 'masculino', null, ['class' => 'sr-only peer', 'id' => 'masculino']) }}
                <label
                    class="text-sm font-medium dark:peer-checked:bg-blue-800/10 peer-checked:bg-blue-100  dark:text-gray-100 text-slate-700 flex p-5  dark:border-slate-400 border border-gray-300 rounded-lg cursor-pointer focus:outline-none  peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent"
                    for="masculino">Masculino</label>

                <div class="absolute hidden w-5 h-5 peer-checked:block top-5 right-3">
                    <x-heroicon-s-check-circle class="lucide lucide-check-circle w-5 h-5 mr-2 text-blue-500" />
                </div>
            </li>
            <li class="relative">
                {{ Form::radio('gender', 'femenino', null, ['class' => 'sr-only peer', 'id' => 'femenino']) }}
                {{--  <input class="sr-only peer" type="radio" value="femenino" name="gender" id="femenino"
                        {{ $user->gender == 'femenino' ? ' checked' : '' }}> --}}
                <label
                    class="text-sm font-medium dark:peer-checked:bg-blue-800/10 peer-checked:bg-blue-100  dark:text-gray-100 text-slate-700 flex p-5  dark:border-slate-400 border border-gray-300 rounded-lg cursor-pointer focus:outline-none  peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent"
                    for="femenino">Femenino</label>

                <div class="absolute hidden w-5 h-5 peer-checked:block top-5 right-3">
                    <x-heroicon-s-check-circle class="lucide lucide-check-circle w-5 h-5 mr-2 text-blue-500" />
                </div>
            </li>



        </ul>
    </div>

    <div class="mt-6">
        <label class="form-label font-medium">Fecha de Nacimiento</label>
        {{ Form::date('birthday', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('birthday') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('birthday')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mt-6">
        <label class="form-label font-medium">Celular</label>
        {{ Form::text('phone', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('phone') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('phone')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mt-6">

        <label class="form-label font-medium">Oficina</label>
        {{ Form::select('office_id', $offices, null, [
            'class' => 'tom-select w-full' . ($errors->has('office_id') ? ' border-danger' : ''),
            'autocomplete' => 'off',
            'data-placeholder' => 'Seleccione la categoria',
        ]) }}

        @error('office_id')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="mt-6">
        <label class="form-label font-medium">Correo</label>
        {{ Form::text('email', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('email') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

        @error('email')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

</div>
