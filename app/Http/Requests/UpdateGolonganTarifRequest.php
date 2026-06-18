<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGolonganTarifRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'max:100', Rule::unique('golongan_tarif')->ignore($this->route('golongan_tarif'))],
            'tarif_per_m3' => ['required', 'numeric', 'min:0'],
            'biaya_beban' => ['required', 'numeric', 'min:0'],
            'denda' => ['required', 'numeric', 'min:0'],
        ];
    }
}
