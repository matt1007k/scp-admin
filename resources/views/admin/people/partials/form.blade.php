<div class="grid gap-5">

  <div>
    <label class="form-label font-medium">Nombres</label>
    {{ Form::text('nombre', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('nombre') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('nombre')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">Apellido Paterno</label>
    {{ Form::text('apellido_paterno', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('apellido_paterno') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('apellido_paterno')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">Apellido Materno</label>
    {{ Form::text('apellido_materno', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('apellido_materno') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('apellido_materno')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">DNI / Numeró de Documento</label>
    {{ Form::text('dni', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('dni') ? ' border-danger' : ''), 'autocomplete' => 'off', 'maxLength' => '9']) }}

    @error('dni')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">Código Modular</label>
    {{ Form::text('codigo_modular', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('codigo_modular') ? ' border-danger' : ''), 'autocomplete' => 'off', 'maxLength' => '10']) }}

    @error('codigo_modular')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div>
    <label class="form-label font-medium">Cargo</label>
    <input name="cargo" type="text" class=" form-control w-full border {{ $errors->has('cargo') ? ' border-danger' : '' }}" value="{{ old('cargo', $person->cargo) }}" autocomplete="off">
    @error('cargo')
    <div class="text-danger mt-2">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div>
    <div class="form-label font-medium">Estado</label>
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <input name="estado" id="activo" type="radio" class="border" value="activo" {{ old('estado', $person->estado) === 'activo' ? 'checked' : ''}}>
          <label id="activo" class="m-0 font-medium">Activo</label>
        </div>
        <div class="flex items-center gap-2">
          <input name="estado" id="sobreviviente" type="radio" class="border" value="sobreviviente" {{ old('estado', $person->estado) === 'sobreviviente' ? 'checked' : ''}}>
          <label id="sobreviviente" class="m-0 font-medium">Sobreviviente</label>
        </div>
        <div class="flex items-center gap-2">
          <input name="estado" id="cesante" type="radio" class="border" value="cesante" {{ old('estado', $person->estado) === 'cesante' ? 'checked' : ''}}>
          <label id="cesante" class="m-0 font-medium">Cesante</label>
        </div>
      </div>
      @error('estado')
      <div class="text-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>

  </div>


  <div class="text-right">
    <a href="{{ route('people.index') }}" class="btn btn-outline-secondary  mr-1">
      <x-heroicon-o-x-mark class="w-4 h-4 mr-1" />
      Cancelar
    </a>
    <button type="submit" class="btn btn-primary">
      <x-heroicon-o-check class="w-4 h-4 mr-1" />
      {{ $btnText }}
    </button>
  </div>
</div>
