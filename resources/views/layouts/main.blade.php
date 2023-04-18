@extends('layouts.base')

@section('body')

    <body class="">
        @yield('content')

        @include('partials._toasts')

        @include('partials._toasts-livewire')

        <!-- BEGIN: JS Assets-->
        @include('layouts.components.scripts')
        @yield('modal-form')
    </body>
@endsection
