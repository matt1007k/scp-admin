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
                    <a href="" class="ml-auto flex items-center text-primary">
                        <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month">
                                            <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $people_count }}</div>
                                <div class="text-base text-slate-500 mt-1">Total de Personas</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="credit-card" class="report-box__icon text-pending"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="2% Lower than last month">
                                            <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $payments_count }}</div>
                                <div class="text-base text-slate-500 mt-1">Total de Pagos</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="monitor" class="report-box__icon text-warning"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="12% Higher than last month">
                                            <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $assets_count }}</div>
                                <div class="text-base text-slate-500 mt-1">Total de Haberes</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-success"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month">
                                            <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                        </div>
                                    </div>
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
