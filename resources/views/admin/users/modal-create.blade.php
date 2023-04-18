<div x-show="isOpen" class="w-screen h-screen fixed inset-0 z-[70] transform translate-y-0">
  <div class="h-full w-full bg-slate-900/50 backdrop-blur grid justify-center items-center">
    <div class="w-full md:w-[500px] z-10 isolate box rounded-lg" @click.outside="isOpen = false">
      <div class="p-5 sm:p-7 grid gap-5">
        <div class="pb-4 flex justify-between items-center border-b border-gray-200 dark:border-slate-700">
          <h3 class="text-xl font-bold">Nuevo Usuario</h3>
          <button @click="isOpen = false" class="w-8 h-8 grid place-items-center rounded-full hover:bg-gray-200 dark:hover:bg-slate-800">
            <x-heroicon-o-x-mark class="w-4 h-4" />
          </button>
        </div>
        <div>
          <form wire:submit.prevent="handleSubmit">
            @include('admin.users.partials.form')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
