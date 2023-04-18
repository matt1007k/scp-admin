@props(['es_imponible'])
@php
$colorClasses = 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400';

switch($es_imponible) {
case '1':
$colorClasses = 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400';
break;
case '0':
$colorClasses = 'bg-red-500/10 text-red-500 dark:bg-red-400/10 dark:text-red-400';
break;
default:
$colorClasses = 'bg-green-500/10 text-green-500 dark:bg-green-400/10 dark:text-green-400';
break;
}

@endphp
<span class="px-2 py-1 {{ $colorClasses }} rounded-full capitalize">
  {{ $es_imponible == 1 ? 'Asegurable' : 'No Asegurable' }}
</span>
