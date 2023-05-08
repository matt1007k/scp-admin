@extends('layouts.side-menu')

@section('subhead', 'Dashboard')

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Resumen de Registros</h2>

                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in border">
                                <div class="box p-5">
                                    <div class="flex">
                                        <x-heroicon-o-users class="text-primary w-6 h-6 mr-1" />
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $people_count }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total de Personas</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in border">
                                <div class="box p-5">
                                    <div class="flex">
                                        <x-heroicon-o-banknotes class="text-primary w-6 h-6 mr-1" />
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $payments_count }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total de Pagos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in border">
                                <div class="box p-5">
                                    <div class="flex">
                                        <x-heroicon-o-folder-plus class="text-primary w-6 h-6 mr-1" />
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $assets_count }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total de Haberes</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in border">
                                <div class="box p-5">
                                    <div class="flex">
                                        <x-heroicon-o-folder-minus class="text-primary w-6 h-6 mr-1" />
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $discounts_count }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total de Descuentos</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
            </div>
        </div>
    </div>
@endsection
