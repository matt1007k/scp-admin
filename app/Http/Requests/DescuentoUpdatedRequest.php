<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DescuentoUpdatedRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'codigo' => ['required', 'min:2', Rule::unique('haber_descuentos', 'codigo')->ignore($this->route('discount'))],
      'nombre' => 'required',
      'descripcion' => 'required',
      'descripcion_simple' => 'required',
    ];
  }
}
