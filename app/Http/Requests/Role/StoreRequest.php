<?php

namespace App\Http\Requests\Role;

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
   * @return array
   */
  public function rules(): array
  {
    return [
      'name' => [
        'required',
        'unique:roles'
      ],
      'status' => 'required|in:1,0',
      'permissions' => [
        'required',
        'array',
      ],
    ];
  }

  public function attributes(): array
  {
    return [

      'name' => 'Nombre',
      'permissions' => 'Permisos',

    ];
  }
}
