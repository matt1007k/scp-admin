<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
      'dni' => 'required|digits:8|numeric|unique:users,dni',
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => 'required',
      'estado' => 'required|in:activo,inactivo',
      'roles.*' => [
        'integer',
      ],
      'roles' => [
        'required',
        'array',
      ],
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'Nombre',
      'dni' => 'DNI',
      'email' => 'Correo Electrónico',
      'password' => 'Contraseña',
      'office_id' => 'Oficina',
      'roles' => 'Rol',
    ];
  }
}
