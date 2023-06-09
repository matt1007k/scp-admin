<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PagoResource;
use App\Models\Pago;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentsController extends Controller
{
    public function index(): ResourceCollection
    {
        $year = request('year') ? request('year') : date('Y');
        $dni = request('dni') ? request('dni') : '00000000';

        $payments = Pago::where('anio', $year)
            ->whereHas('persona', function ($query) use ($dni) {
                $query->where('dni', $dni);
            })->latest('mes')->get();

        return PagoResource::collection($payments);
    }

    public function years(): JsonResponse
    {
        $dni = request('dni') ? request('dni') : '00000000';
        $payments = Pago::whereHas('persona', function ($query) use ($dni) {
            $query->where('dni', $dni);
        })
            ->latest('anio')
            ->distinct()
            ->get();

        return response()->json([
            'data' => array_unique($payments->pluck('anio')->toArray())
        ]);
    }
}
