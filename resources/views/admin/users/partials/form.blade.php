<div class="grid gap-5">
  <div>
    <label class="form-label font-medium">Nombre Completo</label>
    {{ Form::text('name', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('name') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('name')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">DNI</label>
    {{ Form::text('dni', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('dni') ? ' border-danger' : ''), 'autocomplete' => 'off', 'maxLength' => '8']) }}

    @error('dni')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">Correo Electrónico</label>
    {{ Form::text('email', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('email') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('email')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div>
    <label class="form-label font-medium">Contraseña</label>
    <input name="password" type="password" class=" form-control w-full border {{ $errors->has('password') ? ' border-danger' : '' }}" value="{{ old('password') }}" autocomplete="off">
    @error('password')
    <div class="text-danger mt-2">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div>
    <div class="form-label font-medium">Estado</label>
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <input name="estado" id="active" type="radio" class="border" value="activo" {{ old('estado', $user->estado) === 'activo' ? 'checked' : ''}}>
          <label id="active" class="m-0 font-medium">Activo</label>
        </div>
        <div class="flex items-center gap-2">
          <input name="estado" id="inactive" type="radio" class="border" value="inactivo" {{ old('estado', $user->estado) === 'inactivo' ? 'checked' : ''}}>
          <label id="inactive" class="m-0 font-medium">Inactivo</label>
        </div>
      </div>
      @error('estado')
      <div class="text-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>

  </div>
  <div>

    <label class="form-label font-medium">Roles</label>
    @foreach ($roles as $role)
    <div class="form-check mt-2">

      {!! Form::checkbox('roles[]', $role->id, null, ['id' => $role->id, 'class' => 'form-check-input']) !!}

      <label class="form-check-label" for="{{ $role->id }}">{{ $role->name }}
        <em>({{ $role->description ?: 'Sin Descripcion' }})</em>
      </label>
    </div>
    @endforeach

    @error('roles')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>


  <div class="text-right">
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary  mr-1">
      <x-heroicon-o-x-mark class="w-4 h-4 mr-1" />
      Cancelar
    </a>
    <button type="submit" class="btn btn-primary">
      <x-heroicon-o-check class="w-4 h-4 mr-1" />
      {{ $btnText }}
    </button>
  </div>
</div>
