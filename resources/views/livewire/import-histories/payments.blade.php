<div>
  <div class="intro-x mt-10 flex items-center h-10">
    <h1 class="text-lg font-medium truncate mr-5">Historial</h1>
    <button onclick="window.location.reload()" class="btn btn-primary ml-auto w-24 shadow-md mr-2 tooltip zoom-in" title="Refrescar historial">
      <x-heroicon-o-arrow-path class="w-6 h-6" />
    </button>

  </div>

  <div class="grid grid-cols-12 gap-6 mt-5">

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
      <table class="table table-report -mt-2 text-base	">
        <thead>
          <tr>
            <th class="border-b-2 whitespace-nowrap table-cell">
              NOMBRE DEL PERIODO
            </th>
            <th class="border-b-2 whitespace-nowrap">
              FECHA DE REGISTRO
            </th>

            <th class="border-b-2 text-center whitespace-nowrap">
              ACCIONES
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($histories as $history)
          <tr class="intro-x">
            <td>
              <span class="font-medium  uppercase">{{ $history->period_name }}</span>
            </td>
            <td class="text-left table-cell">
              {{ $history->createdAtFormat() }}
            </td>
            <td class="table-report__action w-10">
              <div class="flex justify-center items-center">
                <a href="#" class="text-danger dark:text-gray-100 tooltip zoom-in" data-tw-toggle="modal" data-tw-target="#delete-modal-{{ $history->id }}" title="Eliminar pagos">
                  <x-heroicon-o-trash class="w-6 h-6 lucide lucide-trash" />
                </a>
              </div>
            </td>

          </tr>
          @include('admin.import-histories.modal-delete')
          @empty
          <tr>
            <td colspan="3">Sin ningún historial de pagos importados.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>

</div>
