<div class="grid gap-5">
  <div>
    <label class="form-label font-medium">Nombre Completo</label>
    {{ Form::text('name', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('name') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('name')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <div class="form-label font-medium">Estado</label>
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <input name="status" id="active" type="radio" class="border" value="1" {{ old('status', $role->status) === 1 ? 'checked' : ''}}>
          <label id="active" class="m-0 font-medium">Activo</label>
        </div>
        <div class="flex items-center gap-2">
          <input name="status" id="inactive" type="radio" class="border" value="0" {{ old('status', $role->status) === 0 ? 'checked' : ''}}>
          <label id="inactive" class="m-0 font-medium">Inactivo</label>
        </div>
      </div>
      @error('status')
      <div class="text-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>

  </div>

  <div>

    <div>
      <label class="form-label font-medium">Permisos</label>

      <div class="grid grid-cols-12 gap-2">


        @forelse ($permissions_group as $group_name => $permissions)
        <div class="col-span-6">
          <h1 class="capitalize font-bold">{{ $group_name }}</h1>
          @foreach ($permissions as $permission)
          <div class="form-check mt-2">

            {!! Form::checkbox('permissions[]', $permission->id, null, [
            'id' => $permission->id,
            'class' => 'form-check-input ',
            ]) !!}

            <label class="form-check-label capitalize" for="{{ $permission->id }}">{{ $permission->name }}

            </label>
          </div>
          @endforeach
        </div>
        @empty
        <a href="">Sin permisos</a>
        @endforelse
      </div>
      @error('permissions')
      <div class="text-danger my-3">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="text-right">
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary  mr-1">
      <x-heroicon-o-x-mark class="w-4 h-4 mr-1" />
      Cancelar
    </a>
    <button type="submit" class="btn btn-primary">
      <x-heroicon-o-check class="w-4 h-4 mr-1" />
      {{ $btnText }}
    </button>
  </div>
</div>
