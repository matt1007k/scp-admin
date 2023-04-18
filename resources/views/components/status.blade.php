@props(['status' => null])
@php
$colorClasses = 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400';

switch($status) {
case 'activo':
$colorClasses = 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400';
break;
case 'inactivo':
$colorClasses = 'bg-red-500/10 text-red-500 dark:bg-red-400/10 dark:text-red-400';
break;
case 'cesante':
$colorClasses = 'bg-red-500/10 text-red-500 dark:bg-red-400/10 dark:text-red-400';
break;
case 'sobreviviente':
$colorClasses = 'bg-sky-500/10 text-sky-500 dark:bg-sky-400/10 dark:text-sky-400';
break;
default:
$colorClasses = 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400';
break;
}

@endphp
<span class="px-2 py-1 {{ $colorClasses }} rounded-full capitalize">
  {{ $status }}
</span>
