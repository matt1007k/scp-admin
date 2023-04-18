@extends('layouts.base')

@section('body')

<body class="p-0">
    @yield('content')

    {{--
    <!-- BEGIN: JS Assets-->
    <script src="{{ mix('dist/js/app.js') }}"></script>
    <!-- END: JS Assets--> --}}

    @include('layouts.components.scripts')
</body>
@endsection