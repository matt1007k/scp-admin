<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}" --}}>
<!-- BEGIN: Head -->

<meta charset="utf-8">
<link href="{{ asset('build/assets/images/logo.svg') }}" rel="shortcut icon">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Icewall admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
<meta name="keywords" content="admin template, Icewall Admin Template, dashboard template, flat admin template, responsive admin template, web app">
<meta name="author" content="LEFT4CODE">
<title>@yield('head') | DRE AYACUCHO</title>
{{-- <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <style>
        html * {
            font-family: 'Inter', sans-serif;
        }
    </style> --}}
{{-- <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        :root {
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            :root {
                font-family: 'Inter var', sans-serif;
            }
        }
    </style> --}}

@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.components.styles')
<script>
  // It's best to inline this in `head` to avoid FOUC (flash of unstyled content) when changing pages or themes
  if (
    localStorage.getItem('color-theme') === 'dark' ||
    (!('color-theme' in localStorage) &&
      window.matchMedia('(prefers-color-scheme: dark)').matches)
  ) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
</script>
</head>

@yield('body')

@stack('scripts')

</html>
