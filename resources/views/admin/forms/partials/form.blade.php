<form wire:submit.prevent="handleSubmit">
    @if($message)
    <div class="w-full" role="alert">
        <x-alert type="success">{{$message}}</x-alert>
    </div>
    @endif
    <div class="grid gap-5">
        <div>
            <label class="form-label font-medium" id="volume">Tomo</label>
            <livewire:volumes.volume-autocomplete />
        </div>
        <div>
            <h4 class="font-bold mb-5">Tomo Seleccionado</h4>
            <div class="grid gap-3">
                @if($volume)
                <div class="px-4 py-4 rounded-lg border border-gray-300 dark:border-slate-800 grid items-center grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="col-span-1 md:col-span-1">
                        <h5 class="font-bold">{{ $volume->name}}</h5>
                        <p class="text-gray-500 dark:text-gray-300">Año: {{ $volume->year->anio }}</p>
                    </div>
                </div>
                </template>

                @else
                <div class="px-5 py-4 rounded-lg border border-gray-300 dark:border-slate-800">
                    Sin tomo seleccionado.
                </div>
                @endif
            </div>
            @error('volume')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="form-label font-medium">Nombre de Planilla</label>
            {{ Form::text('name', null, ['wire:model' => 'name', 'class' => 'form-control  w-full border bestupper ' . ($errors->has('name') ? ' border-danger' : ''), 'autocomplete' => 'off']) }}

            @error('name')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="form-label font-medium" id="file">Archivo</label>
            @livewire('drag-and-drop-file', ['url' => route('forms.upload')])
            @error('file')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            @if($file)
            <div class="w-full sm:w-40 mx-auto">
                <x-alert type="info">
                    <div class="grid gap-2 grid-cols-3">
                        <a href="{{ \Storage::url($file) }}" target="_blank" class="h-10 w-10 flex items-center justify-center bg-white rounded-lg">
                            <x-bi-file-pdf class="w-6 h-6" />
                        </a>

                        <button type="button" class="flex items-center justify-center text-red-500 dark:text-red-400 rounded-lg col-span-2" wire:click="deleteFile()">
                            Eliminar
                        </button>
                    </div>
                </x-alert>
            </div>
            @endif
        </div>


        <div class="text-right">
            <a href="{{ route('forms.index') }}" class="btn btn-outline-secondary  mr-1">
                <x-heroicon-o-x-mark class="w-4 h-4 mr-1" />
                Cancelar
            </a>
            <button type="submit" class="btn btn-primary">
                <x-heroicon-o-check class="w-4 h-4 mr-1" />
                {{ $btnText }}
            </button>
        </div>
    </div>
</form>
