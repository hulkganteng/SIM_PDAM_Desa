<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeterRequest extends FormRequest
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
            'pelanggan_id' => ['required', 'exists:pelanggan,id'],
            'periode' => ['required', 'regex:/^\d{4}-\d{2}$/'],
            'meter_awal' => ['required', 'integer', 'min:0'],
            'meter_akhir' => ['required', 'integer', 'min:0', 'gte:meter_awal'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
