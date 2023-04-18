<?php

namespace App\Http\Controllers;

use App\Models\HaberDescuento;
use App\Models\Pago;
use App\Models\Persona;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $people_count = Persona::count();
        $payments_count = Pago::count();
        $assets_count = HaberDescuento::where('tipo', 'haber')->count();
        $discounts_count = HaberDescuento::where('tipo', 'descuento')->count();

        return view('dashboard', compact('people_count', 'payments_count', 'assets_count', 'discounts_count'));
    }
}
