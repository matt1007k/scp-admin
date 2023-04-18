<div class="grid gap-5">
  <div>
    <label class="form-label font-medium" id="year">Año</label>
    <select name="year" class="form-control w-full border @error('year') border-danger @enderror">
      @forelse($years as $year)
      <option value="{{ $year->id }}" @if(old('year', $volume->year_id) === $year->id) selected @endif>{{ $year->anio }}</option>
      @empty
      <option>Sin años registrados</option>
      @endforelse
    </select>

    @error('year')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div>
    <label class="form-label font-medium">Nombre del Tomo</label>
    {{ Form::text('name', null, ['class' => 'form-control  w-full border bestupper ' . ($errors->has('name') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

    @error('name')
    <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
  </div>


  <div class="text-right">
    <a href="{{ route('volumes.index') }}" class="btn btn-outline-secondary  mr-1">
      <x-heroicon-o-x-mark class="w-4 h-4 mr-1" />
      Cancelar
    </a>
    <button type="submit" class="btn btn-primary">
      <x-heroicon-o-check class="w-4 h-4 mr-1" />
      {{ $btnText }}
    </button>
  </div>
</div>
