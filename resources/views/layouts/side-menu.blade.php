@extends('layouts.main')

@section('head')
@yield('subhead')
@endsection

@section('content')
@include('layouts.components.mobile-menu')
@include('layouts.components.top-bar')
<div class="w-full">
  <div class="wrapper-box flex gap-5">
    <!-- BEGIN: Side Menu -->

    <nav class="side-nav">
      <div class="uppercase text-gray-300 pb-5 border-b border-slate-800">Menú</div>
      <ul>


        @foreach ($menus as $menu)
        @if ($menu == 'devider')
        <li class="side-nav__devider my-6"></li>
        @else
        @can($menu['can'], $menu['model'])
        <li>
          <a href="{{ isset($menu['sub_menu']) ? 'javascript:;' : route($menu['route']) }}" class="{{ (isset($menu['sub_menu']) ? request()->is($menu['route'] . '*') : $menu['route'] === Route::currentRouteName()) ? 'side-menu side-menu--active' : 'side-menu' }}">
            <div class="side-menu__icon">



              @svg($menu['icon'], 'w-6 h-6')


              {{-- @svg('feathericon-file') --}}
            </div>
            <div class="side-menu__title">
              {{ $menu['title'] }}
              @if (isset($menu['sub_menu']))
              <div class="side-menu__sub-icon {{ request()->is($menu['route'] . '*') ? 'transform rotate-180' : '' }}">
                <x-feathericon-chevron-down />
              </div>
              @endif
            </div>
          </a>
          @if (isset($menu['sub_menu']))
          <ul class="{{ request()->is($menu['route'] . '*') ? 'side-menu__sub-open' : '' }}">
            @foreach ($menu['sub_menu'] as $subMenuKey => $submenu)
            @can($submenu['can'], $submenu['model'])
            <li>
              <a href="{{ route($submenu['route']) }}" class="{{ $submenu['route'] === Route::currentRouteName() ? 'side-menu side-menu--active' : 'side-menu' }}">
                <div class="side-menu__icon">

                  <x-feathericon-corner-down-right />
                </div>
                <div class="side-menu__title">
                  {{ $submenu['title'] }}
                </div>
              </a>
            </li>
            @endcan
            @endforeach
          </ul>
          @endif
        </li>
        @endcan
        @endif
        @endforeach


      </ul>
    </nav>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="px-5 box w-full flex-1">
      @yield('subcontent')
    </div>
    <!-- END: Content -->
  </div>
</div>
@endsection
