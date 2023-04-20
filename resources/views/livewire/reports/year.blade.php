<div class="grid gap-6" x-data="yearReport" x-init="mount">
    <form wire:submit.prevent="handleSearch">
        <div class="grid gap-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="form-label font-medium">Persona</label>
                    <div class="relative">
                        {{ Form::text('people', null, ['wire:model.debounce.300ms' => 'searchPerson', 'placeholder' => 'Buscar por dni, nombre completo', 'class' => 'form-control  w-full border bestupper ', 'autocomplete' => 'off']) }}

                        <ul class="shadow-lg rounded-sm box absolute z-50 min-w-[200px]" x-show="openSearchPerson" @click.outside="openSearchPerson = false" @keydown.escape="openSearchAsset = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-90" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-90">
                            @forelse($people as $person)
                            <li class="py-3 px-4 hover:bg-gray-100 dark:hover:bg-slate-800 cursor-pointer" wire:click="selectedPerson({{ $person }})">
                                <h5 class="font-bold">{{ $person->full_name }}</h5>
                                <p class="text-gray-500 dark:text-gray-300">Número de Documento: {{ $person->dni }}</p>
                                <p class="text-gray-500 dark:text-gray-300">Código Modular: {{ $person->codigo_modular }}</p>
                            </li>
                            @empty
                            <li class="py-2 px-3">Sin resultados.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="grid gap-1">
                    <label for="year">Año</label>
                    <select id="year" wire:model="year" class="form-control border @error('year') border-red-500 @enderror">
                        @foreach($years as $year)
                        <option value="{{ $year->anio }}">{{ $year->anio }}</option>
                        @endforeach
                    </select>
                    @error('year')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div>
                <h4 class="text-base font-bold mb-5">Persona Seleccionada</h4>
                <div class="grid gap-3">
                    <template x-if="person !== null">
                        <div class="px-4 py-4 rounded-lg border border-gray-300 dark:border-slate-800 grid items-center grid-cols-1 md:grid-cols-4 gap-5">
                            <div class="col-span-1 md:col-span-2">
                                <h5 class="font-bold" x-text="person.full_name"></h5>
                                <p class="text-gray-500 dark:text-gray-300" x-text="getDocumentNumber(person.dni)"></p>
                            </div>
                            <div>
                                <h5 class="font-bold" x-text="person.cargo"></h5>
                                <p class="text-gray-500 dark:text-gray-300" x-text="getModularCode(person.codigo_modular)"></p>
                            </div>
                            <div>
                                <h5 class="font-bold">Estado</h5>
                                <span class="chip-status" :class="person.estado" x-text="person.estado"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="person === null">
                        <div class="px-5 py-4 rounded-lg border border-gray-300 dark:border-slate-800">
                            Sin persona seleccionada.
                        </div>
                    </template>
                    @error('person')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    <x-feathericon-search class="w-4 h-4 mr-1" />
                    <span wire:loading wire:target="payment">Buscando...</span>
                    <span>Buscar</span>
                </button>
            </div>
        </div>
    </form>
    @if($isSearch)
    <div class="grid gap-7">
        <h5 class="font-bold text-lg">Resultados de búsqueda</h5>

        @if($payment)
        <div class="px-4 py-4 rounded-lg border border-gray-300 dark:border-slate-800 grid items-center grid-cols-1 md:grid-cols-2 gap-5">
            <div class="col-span-1 md:col-span-1">
                <h5 class="font-bold text-xl">{{ $payment->anio}}</h5>
                <p class="text-gray-500 dark:text-gray-300">{{ $payment->persona->full_name }}</p>
            </div>
            <div class="justify-self-end">
                <h5 class="font-bold">Ver o Descargar</h5>
                <div class="flex gap-1 justify-end">
                    <button @click="viewPDF" class="btn btn-secondary tooltip" title="Imprimir">
                        <x-heroicon-o-eye class="w-4 h-4" />
                    </button>
                    <button @click="downloadPDF" class="btn btn-secondary tooltip" title="Descargar">
                        <x-feathericon-download class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>

        @endif
        @if($message)
        <div class="px-5 py-4 rounded-lg border border-gray-300 dark:border-slate-800">
            {{ $message }}
        </div>
        @endif
    </div>
    @endif

</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('yearReport', () => ({
            person: @entangle('person'),
            searchPerson: @entangle('searchPerson'),
            openSearchPerson: false,
            year: @entangle('year'),
            getDocumentNumber(dni) {
                return `Número de Documento: ${dni}`;
            },
            getModularCode(codigo_modular) {
                return `Código Modular: ${codigo_modular}`;
            },
            viewPDF() {
                let params = {
                    anio: this.year,
                    persona_id: this.person.id,
                };
                const params_code = window.btoa(JSON.stringify(params));
                window.open(`/reporte/por-anio/${params_code}`, "_blank");
            },
            downloadPDF() {
                let params = {
                    anio: this.year,
                    persona_id: this.person.id,
                };
                const params_code = window.btoa(JSON.stringify(params));
                axios({
                    url: `/reporte/por-anio/${params_code}`,
                    method: "GET",
                    responseType: "blob" // important
                }).then(response => {
                    const url = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    const link = document.createElement("a");
                    const name_file = `${this.person.codigo_modular}-${this.year}.pdf`;
                    link.href = url;
                    link.setAttribute("download", name_file); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                });
            },
            mount() {
                this.$watch('searchPerson', value => this.openSearchPerson = value.length > 2);
            }
        }));

    });
</script>
@endpush
