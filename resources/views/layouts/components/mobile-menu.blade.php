<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
  <div class="mobile-menu-bar">
    <a href="" class="flex mr-auto">
      <img class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
    </a>
    <a href="javascript:;" class="mobile-menu-toggler">

      <x-heroicon-o-bars-3-bottom-right class="w-8 h-8 text-white transform " />
    </a>
  </div>
  <div class="scrollable">
    <a href="javascript:;" class="mobile-menu-toggler">
      <x-heroicon-o-x-circle class="w-8 h-8 text-white transform " />
    </a>
    <ul class="scrollable__content py-2">

      <div class="uppercase text-gray-300 px-5 py-5 border-b border-slate-800">Menú</div>

      @foreach ($menus as $menu)
      @if ($menu == 'devider')
      <li class="menu__devider my-6"></li>
      @else
      @can($menu['can'], $menu['model'])
      <li>
        <a href="{{ isset($menu['sub_menu']) ? 'javascript:;' : route($menu['route']) }}" class="{{ (isset($menu['sub_menu']) ? request()->is($menu['route'] . '*') : $menu['route'] === Route::currentRouteName()) ? 'menu menu--active' : 'menu' }}">
          <div class="menu__icon">
            @svg($menu['icon'], 'w-6 h-6')
          </div>
          <div class="menu__title">
            {{ $menu['title'] }}
            @if (isset($menu['sub_menu']))
            <div class="menu__sub-icon {{ request()->is($menu['route'] . '*') ? 'transform rotate-180' : '' }}">
              <x-feathericon-chevron-down />
            </div>
            @endif

          </div>
        </a>
        @if (isset($menu['sub_menu']))
        <ul class="{{ request()->is($menu['route'] . '*') ? 'menu__sub-open' : '' }} ">
          @foreach ($menu['sub_menu'] as $subMenuKey => $submenu)
          @can($submenu['can'], $submenu['model'])
          <li>
            <a href="{{ route($submenu['route']) }}" class="{{ $submenu['route'] === Route::currentRouteName() ? 'menu menu--active font-bold' : 'menu' }}">
              <div class="menu__icon">
                <x-feathericon-corner-down-right />
              </div>
              <div class="menu__title">
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
      {{-- @foreach ($side_menu as $menuKey => $menu)
            @if ($menu == 'devider')
            <li class="menu__devider my-6"></li>
            @else
            <li>
                <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], $menu['params']) : 'javascript:;' }}"
      class="{{ $first_level_active_index == $menuKey ? 'menu menu--active' : 'menu' }}">
      <div class="menu__icon">
        <i data-lucide="{{ $menu['icon'] }}"></i>
      </div>
      <div class="menu__title">
        {{ $menu['title'] }}
        @if (isset($menu['sub_menu']))
        <i data-lucide="chevron-down" class="menu__sub-icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}"></i>
        @endif
      </div>
      </a>
      @if (isset($menu['sub_menu']))
      <ul class="{{ $first_level_active_index == $menuKey ? 'menu__sub-open' : '' }}">
        @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
        <li>
          <a href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}" class="{{ $second_level_active_index == $subMenuKey ? 'menu menu--active' : 'menu' }}">
            <div class="menu__icon">
              <i data-lucide="activity"></i>
            </div>
            <div class="menu__title">
              {{ $subMenu['title'] }}
              @if (isset($subMenu['sub_menu']))
              <i data-lucide="chevron-down" class="menu__sub-icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}"></i>
              @endif
            </div>
          </a>
          @if (isset($subMenu['sub_menu']))
          <ul class="{{ $second_level_active_index == $subMenuKey ? 'menu__sub-open' : '' }}">
            @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
            <li>
              <a href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}" class="{{ $third_level_active_index == $lastSubMenuKey ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                  <i data-lucide="zap"></i>
                </div>
                <div class="menu__title">{{ $lastSubMenu['title'] }}</div>
              </a>
            </li>
            @endforeach
          </ul>
          @endif
        </li>
        @endforeach
      </ul>
      @endif
      </li>
      @endif
      @endforeach --}}
    </ul>
  </div>
</div>
<!-- END: Mobile Menu -->
