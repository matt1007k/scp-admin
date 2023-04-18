<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'ap_paterno' => ['required', 'string', 'max:255'],
            'ap_materno' => ['required', 'string', 'max:255'],
            'dni' => 'required|digits:8|numeric|unique:users,dni',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'gender' => 'required',
            'birthday' => 'required',
            'phone' => 'required',
            'office_id' => 'required',

        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nombre',
            'ap_paterno' => 'Apellido Paterno',
            'ap_materno' => 'Apellido Materno',
            'dni' => 'DNI',
            'email' => 'Correo Electrónico',
            'password' => 'Contraseña',
            'gender' => 'Género',
            'birthday' => 'Fecha de Nacimiento',
            'phone' => 'Celular',
            'office_id' => 'Oficina',
        ];
    }
}
