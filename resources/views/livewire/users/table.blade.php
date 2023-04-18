<div>
  <div class="intro-x mt-10 flex items-center h-10">
    <h1 class="text-xl font-medium truncate mr-5">Lista de Usuarios</h1>
    @can('create', 'Models\User')
    <a href="{{ route('users.create') }}" class="btn btn-primary ml-auto  w-24 shadow-md mr-2 ">
      <x-feathericon-plus class="mr-2 h-5 w-5" />
      Crear
    </a>
    @endcan

  </div>

  <div class="mt-5 w-full border-b-2 border-gray-300 dark:border-slate-700 flex">
    <div class="py-3 px-5 cursor-pointer font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-800 border-b-4 hover:text-black dark:hover:text-white @if($filterValue === '') text-black border-sky-500 bg-gray-200 dark:text-white dark:border-sky-500 dark:bg-slate-800 @endif" wire:click="filterBy('')">Todos</div>
    <div class="py-3 px-5 cursor-pointer font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-800 border-b-4 hover:text-black dark:hover:text-white @if($filterValue === 'activo') text-black border-sky-500 bg-gray-200 dark:text-white dark:border-sky-500 dark:bg-slate-800 @endif" wire:click="filterBy('activo')">Activos</div>
    <div class="py-3 px-5 cursor-pointer font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-800 border-b-4 hover:text-black dark:hover:text-white @if($filterValue === 'inactivo') text-black border-sky-500 bg-gray-200 dark:text-white dark:border-sky-500 dark:bg-slate-800 @endif" wire:click="filterBy('inactivo')">Inactivos</div>
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
          <input wire:model="search" type="text" class="form-control w-56  pr-10 placeholder-slate-500" placeholder="Buscar...">
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
            <th width="3%" wire:click.prevent="sortBy('id')" class="border-b-2 whitespace-nowrap table-cell">
              <a href="#" role="button" class="flex items-center rounded-md">
                @include('partials._sort-icon', ['field' => 'id'])ID
              </a>
            </th>
            <th wire:click.prevent="sortBy('name')" class="border-b-2 whitespace-nowrap">
              <a href="#" role="button" class="flex items-center rounded-md">
                @include('partials._sort-icon', ['field' => 'name'])NOMBRE
              </a>
            </th>
            <th wire:click.prevent="sortBy('email')" class="border-b-2 whitespace-nowrap">
              <a href="#" role="button" class="flex items-center rounded-md uppercase">
                @include('partials._sort-icon', ['field' => 'email'])Correo Electrónico
              </a>
            </th>
            @can('status', $users)
            <th wire:click.prevent="sortBy('estado')" class="border-b-2 ">
              <a href="#" role="button" class="flex items-center rounded-md">
                @include('partials._sort-icon', ['field' => 'estado'])ESTADO
              </a>
            </th>
            @endcan
            <th class="border-b-2 whitespace-nowrap">
              <a href="#" role="button" class="flex items-center rounded-md uppercase">
                Roles
              </a>
            </th>
            <th wire:click.prevent="sortBy('created_at')" class="border-b-2 whitespace-nowrap">
              <a href="#" role="button" class="flex items-center rounded-md uppercase">
                @include('partials._sort-icon', ['field' => 'created_at'])FECHA DE REGISTRO
              </a>
            </th>

            <th class="border-b-2 text-center whitespace-nowrap">
              <a href="#" role="button" class="text-center  px-3 py-2 mt-3 rounded-md">
                ACCIONES
              </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr class="intro-x">
            <td width="3%" class="text-center table-cell">
              {{ $user->id }}
            </td>
            <td>
              <span class="font-medium  uppercase">{{ $user->name }}</span>
              <div class="text-slate-500 text-xs  mt-0.5">DNI {{ $user->dni }}
              </div>
            </td>
            <td class="text-left table-cell">
              {{ $user->email }}
            </td>
            @can('status', $user)
            <td width="3%" class="text-left">
              <x-status :status="$user->estado" />
            </td>
            @endcan
            <td class="text-left table-cell">
              {{ $user->roles->map(fn($role) => $role->name)->join(', ') }}
            </td>
            <td width="3%" class="text-left table-cell">
              {{ $user->createdAtFormat() }}
            </td>
            <td class="table-report__action w-10">
              <div class="flex justify-center items-center">
                @can('update', $user)
                <a href="{{ route('users.edit', $user) }}" class="text-primary mr-3 tooltip dark:text-gray-100 zoom-in " title="Editar">
                  <x-heroicon-o-pencil-square class="w-6 h-6 lucide lucide-edit" />
                </a>
                @endcan
                @can('forceDelete', $user)
                <a href="#" class="text-danger dark:text-gray-100 tooltip zoom-in" data-tw-toggle="modal" data-tw-target="#delete-modal-{{ $user->id }}" title="Eliminar">
                  <x-heroicon-o-trash class="w-6 h-6 lucide lucide-trash" />
                </a>
                @endcan
              </div>
            </td>

          </tr>
          @include('admin.users.modal-delete')
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

      @include('partials._empty', [
      'var' => $users,
      'route' => 'users.create',
      'text' => 'Empiece por crear un Usuario.',
      ])
    </div>

  </div>

</div>
