<div class="grid gap-5">

  <div>
    <label class="form-label font-medium">Código</label>
    {{ Form::text('codigo', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('codigo') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}
    <div>Nota: Es importante anteponer la letra H y luego el identificador del SUP: Ejemplo (H22)</div>
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

  <div>
    <div class="form-label font-medium">Asegurable</label>
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <input name="es_imponible" id="si" type="radio" class="border" value="1" {{ old('es_imponible', $asset->es_imponible) == 1 ? 'checked' : ''}}>
          <label id="si" class="m-0 font-medium">Si</label>
        </div>
        <div class="flex items-center gap-2">
          <input name="es_imponible" id="no" type="radio" class="border" value="0" {{ old('es_imponible', $asset->es_imponible) == 0 ? 'checked' : ''}}>
          <label id="no" class="m-0 font-medium">No</label>
        </div>
      </div>
      @error('es_imponible')
      <div class="text-danger mt-2">
        {{ $message }}
      </div>
      @enderror
    </div>

  </div>

  <div class="text-right">
    <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary  mr-1">
      <x-heroicon-o-x-mark class="w-4 h-4 mr-1" />
      Cancelar
    </a>
    <button type="submit" class="btn btn-primary">
      <x-heroicon-o-check class="w-4 h-4 mr-1" />
      {{ $btnText }}
    </button>
  </div>
</div>
