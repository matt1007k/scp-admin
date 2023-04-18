<div id="delete-modal-{{ $form->id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-5 grid gap-5">
                <div class="flex flex-col sm:flex-row gap-4 items-center sm:items-start">
                    <x-feathericon-trash-2 class="w-10 h-10 sm:w-8 sm:h-8 text-danger lucide lucide-trash-2" />
                    <div class="text-center sm:text-left">
                        <div class="text-xl">Eliminar</div>
                        <div class="text-gray-600 mt-2 dark:text-slate-500">¿Realmente desea eliminar este registro? <br> Este proceso no se puede deshacer.</div>
                    </div>
                </div>
                <div class="mt-5 flex flex-col-reverse sm:flex-row gap-2 justify-items-stretch sm:justify-end">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary">Cancelar</button>
                    <button wire:click="destroy({{ $form->id }})" type="button" class="btn btn-danger">Si, eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>
