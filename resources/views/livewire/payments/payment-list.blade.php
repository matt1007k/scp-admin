<div>
    <div class="intro-x mt-10 flex items-center h-10">
        <h1 class="text-xl font-medium truncate mr-5">Lista de Pagos</h1>
        @can('create', 'Models\Pago')
            <a href="{{ route('payments.create') }}" class="btn btn-primary ml-auto  w-24 shadow-md mr-2 ">
                <x-feathericon-plus class="mr-2 h-5 w-5" />
                Crear
            </a>
        @endcan
    </div>

    <div class="mt-5 w-full sm:w-3/4 md:w-[500px] border-b-2 border-gray-300 dark:border-slate-700">
        <h4 class="text-base font-bold mb-2">Periodo</h4>
        <div class="grid grid-cols-2 gap-2">
            <div class="grid gap-1">
                <label for="year">Año</label>
                <select id="year" wire:model="year" class="form-control">
                    @foreach ($years as $year)
                        <option value="{{ $year->anio }}">{{ $year->anio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid gap-1">
                <label for="month">Mes</label>
                <select id="month" wire:model="month" class="form-control">
                    @foreach ($months as $month)
                        <option value="{{ $month['numero'] }}">{{ $month['nombre'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="mt-5 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
        <div class="dark:text-gray-300">
            <select wire:model="perPage" class="w-20 form-select  mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>

        </div>

        <div class="sm:ml-auto mt-2 sm:mt-0 dark:text-gray-300">
            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input wire:model="search" type="text" class="form-control w-56  pr-10 placeholder-slate-500"
                        placeholder="Buscar...">
                    @if ($search == '')
                        <x-feathericon-search class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" />
                    @else
                        <button wire:click="clear" class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0  ">
                            <x-feathericon-x class="w-4 h-4 " />
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">


        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <table class="table table-report -mt-2 text-base	">
                <thead>
                    <tr>
                        <th width="3%" wire:click.prevent="sortBy('id')"
                            class="border-b-2 whitespace-nowrap table-cell">
                            <a href="#" role="button" class="flex items-center rounded-md">
                                @include('partials._sort-icon', ['field' => 'id'])ID
                            </a>
                        </th>
                        <th class="border-b-2 whitespace-nowrap">
                            PERSONA
                        </th>
                        <th wire:click.prevent="sortBy('anio')" class="border-b-2 whitespace-nowrap">
                            <a href="#" role="button" class="flex items-center rounded-md uppercase">
                                @include('partials._sort-icon', ['field' => 'anio'])AÑO
                            </a>
                        </th>
                        <th wire:click.prevent="sortBy('mes')" class="border-b-2 whitespace-nowrap">
                            <a href="#" role="button" class="flex items-center rounded-md uppercase">
                                @include('partials._sort-icon', ['field' => 'mes'])MES
                            </a>
                        </th>
                        <th wire:click.prevent="sortBy('total_haber')" class="border-b-2 whitespace-nowrap">
                            <a href="#" role="button" class="flex items-center rounded-md uppercase">
                                @include('partials._sort-icon', ['field' => 'total_haber'])TOTAL HABER
                            </a>
                        </th>
                        <th wire:click.prevent="sortBy('total_descuento')" class="border-b-2 whitespace-nowrap">
                            <a href="#" role="button" class="flex items-center rounded-md uppercase">
                                @include('partials._sort-icon', ['field' => 'total_descuento'])TOTAL DESCUENTO
                            </a>
                        </th>
                        <th wire:click.prevent="sortBy('monto_imponible')" class="border-b-2 whitespace-nowrap">
                            <a href="#" role="button" class="flex items-center rounded-md uppercase">
                                @include('partials._sort-icon', ['field' => 'monto_imponible'])MONTO ASEGURABLE
                            </a>
                        </th>
                        <th wire:click.prevent="sortBy('monto_liquido')" class="border-b-2 whitespace-nowrap">
                            <a href="#" role="button" class="flex items-center rounded-md uppercase">
                                @include('partials._sort-icon', ['field' => 'monto_liquido'])MONTO LIQUIDO
                            </a>
                        </th>


                        <th class="border-b-2 text-center whitespace-nowrap">
                            ACCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr class="intro-x">
                            <td width="3%" class="text-center table-cell">
                                {{ $payment->id }}
                            </td>
                            <td>
                                <span class="font-medium  uppercase">{{ $payment->persona->fullName }}</span>
                            </td>
                            <td class="text-right table-cell">
                                {{ $payment->anio }}
                            </td>
                            <td class="text-right table-cell">
                                {{ $payment->mes }}
                            </td>
                            <td class="text-right table-cell">
                                {{ $payment->total_haber }}
                            </td>
                            <td class="text-right table-cell">
                                {{ $payment->total_descuento }}
                            </td>
                            <td class="text-right table-cell">
                                {{ $payment->monto_imponible }}
                            </td>
                            <td class="text-right table-cell">
                                {{ $payment->monto_liquido }}
                            </td>

                            <td class="table-report__action w-10">
                                <div class="flex justify-center items-center">
                                    @can('update', $payment)
                                        <a href="{{ route('payments.edit', $payment) }}"
                                            class="text-primary mr-3 tooltip dark:text-gray-100 zoom-in " title="Editar">
                                            <x-heroicon-o-pencil-square class="w-6 h-6 lucide lucide-edit" />
                                        </a>
                                    @endcan
                                    @can('forceDelete', $payment)
                                        <a href="#" class="text-danger dark:text-gray-100 tooltip zoom-in"
                                            data-tw-toggle="modal" data-tw-target="#delete-modal-{{ $payment->id }}"
                                            title="Eliminar">
                                            <x-heroicon-o-trash class="w-6 h-6 lucide lucide-trash" />
                                        </a>
                                    @endcan
                                </div>
                            </td>

                        </tr>
                        @include('admin.payments.modal-delete')
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

            @include('partials._empty', [
                'var' => $payments,
                'route' => 'payments.create',
                'text' => 'Empiece por crear un Pago.',
            ])
        </div>

    </div>

</div>
