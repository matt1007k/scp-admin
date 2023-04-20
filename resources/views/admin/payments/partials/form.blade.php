<form wire:submit.prevent="handleSubmit">
    <div class="grid gap-5" x-data="paymentForm" x-init="mount">
        @if($message !== '')
        <div class="p-4 rounded-lg bg-green-500 text-white dark:bg-green-300 dark:text-black">{{ $message }}</div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-5 gap-5">
            <div>
                <label class="form-label font-medium">Persona</label>
                <div class="relative">
                    {{ Form::text('people', null, ['x-model' => 'searchPerson', 'placeholder' => 'Buscar por dni, nombre completo', 'class' => 'form-control  w-full border bestupper ', 'autocomplete' => 'off']) }}

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
            <div class="grid gap-1">
                <label for="month">Mes</label>
                <select id="month" wire:model="month" class="form-control border @error('month') border-red-500 @enderror">
                    @foreach($months as $month)
                    <option value="{{ $month['numero'] }}">{{ $month['nombre'] }}</option>
                    @endforeach
                </select>
                @error('month')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="form-label font-medium">Agregar Haber</label>
                <div class="relative">
                    {{ Form::text('assets', null, ['x-model' => 'searchAsset', 'placeholder' => 'Buscar por descripción', 'class' => 'form-control  w-full border bestupper ', 'autocomplete' => 'off']) }}

                    <ul class="shadow-lg rounded-sm box absolute z-50 min-w-[200px]" x-show="openSearchAsset" @click.outside="openSearchAsset = false" @keydown.escape="openSearchAsset = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-90" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-90">
                        @forelse($assetsDB as $asset)
                        <li class="py-3 px-4 hover:bg-gray-100 dark:hover:bg-slate-800 cursor-pointer" wire:click="selectedAsset({{ $asset }})">
                            <h5 class="font-bold">{{ $asset->nombre }}</h5>
                            <p class="text-gray-500 dark:text-gray-300">{{ $asset->descripcion_simple }}</p>
                        </li>
                        @empty
                        <li class="py-2 px-3">Sin resultados.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div>
                <label class="form-label font-medium">Agregar Descuento</label>
                <div class="relative">
                    {{ Form::text('discounts', null, ['x-model' => 'searchDiscount', 'placeholder' => 'Buscar por descripción','class' => 'form-control  w-full border bestupper ', 'autocomplete' => 'off']) }}

                    <ul class="shadow-lg rounded-sm box absolute z-50 min-w-[200px]" x-show="openSearchDiscount" @click.outside="openSearchDiscount = false" @keydown.escape="openSearchDiscount = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-y-90" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-90">
                        @forelse($discountsDB as $discount)
                        <li class="py-3 px-4 hover:bg-gray-100 dark:hover:bg-slate-800 cursor-pointer" wire:click="selectedDiscount({{ $discount }})">
                            <h5 class="font-bold">{{ $discount->nombre }}</h5>
                            <p class="text-gray-500 dark:text-gray-300">{{ $discount->descripcion_simple }}</p>
                        </li>
                        @empty
                        <li class="py-2 px-3">Sin resultados.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div>
            <h4 class="text-base font-bold mb-5">Persona Seleccionada</h4>
            <div class="grid gap-3">
                <template x-if="person !== null">
                    <div class="px-4 py-4 rounded-lg border border-gray-300 dark:border-slate-800 grid items-center grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="col-span-1 md:col-span-1">
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
            </div>
            @error('person')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="overflow-y-auto max-h-96">
            <h4 class="text-base font-bold mb-5">Haberes</h4>
            <div class="grid gap-3">
                <template x-if="assets.length > 0">
                    <template x-for="asset in assets">

                        <div class="px-4 py-4 rounded-lg border border-gray-300 dark:border-slate-800 grid items-center grid-cols-1 md:grid-cols-5 gap-5">
                            <div class="col-span-1 md:col-span-2">
                                <h5 class="font-bold" x-text="asset.nombre"></h5>
                                <p class="text-gray-500 dark:text-gray-300" x-text="asset.descripcion_simple"></p>
                            </div>
                            <div>
                                <span class="px-2 py-1 rounded-full capitalize" :class="asset.es_imponible ? 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400' : 'bg-red-500/10 text-red-500 dark:bg-red-400/10 dark:text-red-400'" x-text=" asset.es_imponible ? 'Asegurable' : 'No Asegurable'">
                                </span>
                            </div>
                            <div>
                                <label class=" form-label font-medium">Monto S/</label>
                                <input class="form-control" x-model="asset.monto" type="number" step="0.01" />
                            </div>
                            <div class="flex justify-end">
                                <button type="button" @click="deleteAsset(asset.id)" class="text-danger dark:text-gray-100 tooltip zoom-in" title="Eliminar">
                                    <x-heroicon-o-trash class="w-6 h-6 lucide lucide-trash" />
                                </button>
                            </div>
                        </div>
                    </template>
                </template>

                <template x-if="!assets.length > 0">
                    <div class="px-5 py-4 rounded-lg border border-gray-300 dark:border-slate-800">
                        Sin haberes agregados.
                    </div>
                </template>
            </div>
            @error('assets')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="overflow-y-auto max-h-96">
            <h4 class="text-base font-bold mb-5">Descuentos</h4>
            <div class="grid gap-3">
                <template x-if="discounts.length > 0">
                    <template x-for="discount in discounts">

                        <div class="px-4 py-4 rounded-lg border border-gray-300 dark:border-slate-800 grid items-center grid-cols-1 md:grid-cols-4 gap-5">
                            <div class="col-span-1 md:col-span-2">
                                <h5 class="font-bold" x-text="discount.nombre"></h5>
                                <p class="text-gray-500 dark:text-gray-300" x-text="discount.descripcion_simple"></p>
                            </div>
                            <div>
                                <label class=" form-label font-medium">Monto S/</label>
                                <input class="form-control" x-model="discount.monto" type="number" step="0.01" />
                            </div>
                            <div class="flex justify-end">
                                <button type="button" @click="deleteDiscount(discount.id)" class="text-danger dark:text-gray-100 tooltip zoom-in" title="Eliminar">
                                    <x-heroicon-o-trash class="w-6 h-6 lucide lucide-trash" />
                                </button>
                            </div>
                        </div>
                    </template>
                </template>

                <template x-if="!discounts.length > 0">
                    <div class="px-5 py-4 rounded-lg border border-gray-300 dark:border-slate-800">
                        Sin descuentos agregados.
                    </div>
                </template>
            </div>
            @error('discounts')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="p-5 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5 bg-gray-50 dark:bg-slate-800 ">
            <div class="text-right">
                <h3 class="font-bold text-gray-500 dark:text-gray-400">Total Haber</h3>
                <p class="text-lg font-bold">
                    S/ <span x-text="assetsTotal"></span>
                </p>
            </div>
            <div class="text-right">
                <h3 class="font-bold text-gray-500 dark:text-gray-400">Total Descuento</h3>
                <p class="text-lg font-bold">
                    S/ <span x-text="discountsTotal"></span>
                </p>
            </div>
            <div class="text-right">
                <h3 class="font-bold text-gray-500 dark:text-gray-400">Monto Imponible</h3>
                <p class="text-lg font-bold">
                    S/ <span x-text="imponibleTotal"></span>
                </p>
            </div>
            <div class="text-right">
                <h3 class="font-bold text-gray-500 dark:text-gray-400">Monto Líquido</h3>
                <p class="text-lg font-bold">
                    S/ <span x-text="liquidTotal"></span>
                </p>
            </div>
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

</form>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('paymentForm', () => ({
            person: @entangle('person'),
            searchPerson: @entangle('searchPerson'),
            openSearchPerson: false,
            searchAsset: @entangle('searchAsset'),
            assets: @entangle('assets'),
            assetsTotal: @entangle('assetsTotal'),
            openSearchAsset: false,
            deleteAsset(id) {
                this.assets = this.assets.filter((asset) => asset.id !== id);
            },
            searchDiscount: @entangle('searchDiscount'),
            discounts: @entangle('discounts'),
            discountsTotal: @entangle('discountsTotal'),
            openSearchDiscount: false,
            deleteDiscount(id) {
                this.assets = this.discounts.filter((discount) => discount.id !== id);
            },
            liquidTotal: @entangle('liquidTotal'),
            imponibleTotal: @entangle('imponibleTotal'),
            getAssetsTotal() {
                return Number(this.assets.reduce((total, item) => total += Number(item.monto), 0)).toFixed(2);
            },
            getDiscountsTotal() {
                return Number(this.discounts.reduce((total, item) => total += Number(item.monto), 0)).toFixed(2);
            },
            getLiquidTotal() {
                return Number(this.getAssetsTotal() - this.getDiscountsTotal()).toFixed(2);
            },
            getImponibleTotal() {
                return Number(this.assets.filter((item) => item.es_imponible).reduce((total, item) => total += Number(item.monto), 0)).toFixed(2);
            },
            getDocumentNumber(dni) {
                return `Número de Documento: ${dni}`;
            },
            getModularCode(codigo_modular) {
                return `Código Modular: ${codigo_modular}`;
            },
            mount() {
                this.$watch('searchAsset', value => this.openSearchAsset = value.length > 2);
                this.$watch('searchDiscount', value => this.openSearchDiscount = value.length > 2);
                this.$watch('searchPerson', value => this.openSearchPerson = value.length > 2);
                this.$watch('getAssetsTotal', value => this.assetsTotal = value);
                this.$watch('getDiscountsTotal', value => this.discountsTotal = value);
                this.$watch('getImponibleTotal', value => this.imponibleTotal = value);
                this.$watch('getLiquidTotal', value => this.liquidTotal = value);
            }
        }));

    });
</script>
@endpush
