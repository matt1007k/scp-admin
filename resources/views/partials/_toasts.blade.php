
@if (session('success'))
<div id="success-toast" class="toastify-content hidden flex">
    <x-feathericon-check-circle class="text-success" />
    <div class="ml-4 mr-4">
        <div class="font-bold text-success">Exito</div>
        <div class="text-gray-600 mt-1 dark:text-slate-500">{{ session('success') }}</div>
    </div>
</div>
@elseif (session('danger'))
<div id="danger-toast" class="toastify-content hidden flex">
    <x-feathericon-x-octagon class="text-danger" />
    <div class="ml-4 mr-4">
        <div class="font-bold text-danger">Alerta</div>
        <div class="text-gray-600 mt-1 dark:text-slate-500">{{ session('danger') }}</div>
    </div>
</div>
@elseif (session('warning'))
<div id="warning-toast" class="toastify-content hidden flex">
    <x-feathericon-alert-triangle class="text-warning" />
    <div class="ml-4 mr-4">
        <div class="font-bold text-warning">Alerta</div>
        <div class="text-gray-600 mt-1 dark:text-slate-500">{{ session('warning') }}</div>
    </div>
</div>
@elseif (session('info'))
<div id="info-toast" class="toastify-content hidden flex">
    <x-feathericon-shield class="text-primarylight" />
    <div class="ml-4 mr-4">
        <div class="font-bold text-primarylight">Información</div>
        <div class="text-gray-600 mt-1 dark:text-slate-500">{{ session('info') }}</div>
    </div>
</div>
@endif
