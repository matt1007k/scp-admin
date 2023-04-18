<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
      'dni' => ['required', 'digits:8', 'numeric', Rule::unique('users', 'dni')->ignore($this->route('user'))],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('user'))],
      'estado' => 'required|in:activo,inactivo',
      'roles' => 'required|array'
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'Nombre',
      'dni' => 'DNI',
      'email' => 'Correo Electrónico',
    ];
  }
}
