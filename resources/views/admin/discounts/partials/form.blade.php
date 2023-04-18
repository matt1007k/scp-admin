<div class="grid gap-5">

  <div>
    <label class="form-label font-medium">Código</label>
    {{ Form::text('codigo', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('codigo') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}
    <div>Nota: Es importante anteponer la letra D y luego el identificador del SUP: Ejemplo (D23)</div>
    @error('codigo')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div>
    <label class="form-label font-medium">Nombre</label>
    {{ Form::text('nombre', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('nombre') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('nombre')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">Descripción</label>
    {{ Form::text('descripcion', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('descripcion') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('descripcion')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>

  <div>
    <label class="form-label font-medium">Descripción Simple</label>
    {{ Form::text('descripcion_simple', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('descripcion_simple') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('descripcion_simple')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
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
