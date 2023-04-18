<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class FormsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Form::class, 'form');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $breadcrumbs = [
            ["link" => "/dashboard", "name" => "Home"], ["name" => "Planillas"],
        ];
        return view('admin.forms.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.e
     */
    public function create(): View
    {
        $breadcrumbs = [
            ["link" => "/dashboard", "name" => "Home"],
            ["link" => "/forms", "name" => "Planillas"],
            ["name" => "Crear"],
        ];

        return view('admin.forms.create', compact('breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form): View
    {
        $breadcrumbs = [
            ["link" => "/dashboard", "name" => "Home"],
            ["link" => "/forms", "name" => "Planillas"],
            ["name" => "Editar"],
        ];

        return view('admin.forms.edit', compact('form', 'breadcrumbs'));
    }

    public function uploadFile(): JsonResponse
    {
        request()->validate([
            'file' => 'file|max:20000|mimes:pdf',
        ]);

        $file_name = 'planilla_' . request()->file('file')->getClientOriginalName();
        $file_path = request()->file('file')->storeAs('forms', $file_name, 'public');

        return response()->json([
            'file_path' => $file_path
        ]);
    }
}
