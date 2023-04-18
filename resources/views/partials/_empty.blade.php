@if ($var->count())
    {{ $var->links('partials._custom-pagination') }}
@elseif ($var->empty() && $search == '')
    <div class="grid grid-cols-12 gap-6 mt-5 align-center">
        <!-- BEGIN: FAQ Menu -->
        <div class="intro-y col-span-12 lg:col-span-12 box py-10  border-primary dark:border-primary">
            <div class="text-center">

                <x-feathericon-folder-plus class="mx-auto h-12 w-12 text-gray-400" />
                <div class="font-medium text-center text-base mt-3">{{ $text }}</div>
                <div class="mt-4">
                    <a {{isset($livewire) ? 'wire:click='.$livewire  : ''  }} {{isset($route) ? 'href='.route($route) : ''}} 
                        class="btn btn-primary  inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">

                        <x-feathericon-plus class="-ml-1 mr-2 h-5 w-5" />
                        Crear
                    </a>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="grid grid-cols-12 gap-6 mt-5 align-center">
        <!-- BEGIN: FAQ Menu -->
        <div class="intro-y col-span-12 lg:col-span-12 box py-10  border-primary dark:border-primary">
            <div class="w-24 h-24 text-primary dark:primary mx-auto">
                <img src="{{ asset('build/assets/images/emoji.svg') }}" alt="">

            </div>
            <div class="font-medium text-center text-base mt-3">No hay resultados para la búsqueda
                "{{ $search }}" en la página {{ $page }} al mostrar {{ $perPage }} por
                página</div>
        </div>


    </div>
@endif
