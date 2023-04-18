<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function setting(): View
    {
        $breadcrumbs = [
            ["link" => "/dashboard", "name" => "Home"],
            ["name" => "Configuración de Perfil"],
        ];

        $user = Auth::user();

        return view('profile.setting', compact('breadcrumbs', 'user'));
    }

    public function updatePassword(UpdatePasswordRequest $request, User $user): RedirectResponse
    {

        $user->update([
            'password' => Hash::make(request('password')),
        ]);
        return back()->with('success', 'La contraseña se cambió con exitó.');
    }
}
