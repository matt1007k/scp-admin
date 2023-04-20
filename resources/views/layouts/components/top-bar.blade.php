<!-- BEGIN: Top Bar -->
<div
    class="h-[70px] z-[51] relative border-b border-white/[0.08] mt-12 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">

    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <a href="/admin" class="z-10 -intro-x hidden md:flex">
            <img class="w-28" src="{{ asset('build/assets/images/logos/logo-dark.png') }}" alt="Logo" />
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="z-10 -intro-x h-full mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                @isset($breadcrumbs)
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' : '' }}">
                            @if (isset($breadcrumb['link']))
                                <a href="{{ asset($breadcrumb['link']) }}" class="font-normal">
                                    @if ($breadcrumb['name'] == 'Home')
                                        <x-feathericon-home class="w-4 h-4 breadcrumb__icon lucide lucide-home" />
                                        @else{{ $breadcrumb['name'] }}
                                    @endif
                                </a>
                            @else
                                <a aria-current="page">
                                    {{ $breadcrumb['name'] }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                @endisset




                {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> --}}
            </ol>
        </nav>
        <!-- END: Breadcrumb -->
        {{-- <a href="{{ route('frontend.index') }}" class="btn btn-outline-secondary text-slate-300 mr-1">

        <x-feathericon-arrow-up-right class="w-5 h-5 mr-1" />
        Ir al portal
        </a> --}}
        <!-- BEGIN: Notifications -->
        <div class="z-10 intro-x dropdown mr-4 sm:mr-6">
            <label class="cursor-pointer flex items-center ">
                <div class="ml-5 text-gray-100">Tema</div>
                <div class="mr-3 w-8 h-8">
                    <button id="theme-toggle" type="button" class="tooltip " title="Modo Oscuro/Claro">
                        <x-feathericon-moon id="theme-toggle-dark-icon"
                            class="text-primary hidden font-medium p-2 ml-3 w-8 h-8  bg-gray-100 rounded-md transition cursor-pointer hover:bg-gray-200 border" />
                        <x-feathericon-sun id="theme-toggle-light-icon"
                            class="hidden text-warning font-medium p-2 ml-3 w-8 h-8 bg-gray-700 rounded-md transition cursor-pointer" />
                    </button>
                </div>

            </label>

        </div>

        <!-- END: Notifications -->

        <!-- BEGIN: Account Menu -->
        <div class="z-10 intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
                role="button" aria-expanded="false" data-tw-toggle="dropdown">
                @if (Auth::user()->profile_photo)
                    <img src="{{ Auth::user()->profile_photo }}">
                @else
                    <div class="w-8 h-8 flex justify-center items-center bg-sky-400 rounded-full text-white">
                        {{ substr(ucfirst(Auth::user()->name), 0, 1) }}</div>
                @endif
            </div>
            <div class="dropdown-menu w-56">
                <ul
                    class="dropdown-content bg-primarymain/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-white/60 mt-0.5">{{ Auth::user()->dni }}
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="{{ route('account-setting') }}" class="dropdown-item hover:bg-white/5">

                            <x-heroicon-o-cog-6-tooth class="w-4 h-4 mr-2" /> Editar perfil
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>


                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                 this.closest('form').submit();"
                                class="dropdown-item hover:bg-white/5">
                                <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 mr-2" /> Salir
                            </a>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->
