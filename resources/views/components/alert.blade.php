@props(['type'])
@php
$colorClasses = 'bg-green-400 text-white dark:bg-green-300 dark:text-black';
switch($type){
case 'info':
$colorClasses = 'bg-sky-400 text-white dark:bg-sky-300 dark:text-black';
break;
case 'success':
$colorClasses = 'bg-green-400 text-white dark:bg-green-300 dark:text-black';
break;
case 'error':
$colorClasses = 'bg-red-400 text-white dark:bg-red-300 dark:text-black';
break;
case 'warning':
$colorClasses = 'bg-yellow-400 text-white dark:bg-yellow-300 dark:text-black';
break;
default:
$colorClasses = 'bg-green-400 text-white dark:bg-green-300 dark:text-black';
break;
}
@endphp
<div class="w-full px-5 py-5 rounded-lg {{ $colorClasses }}">{{ $slot }}</div>
