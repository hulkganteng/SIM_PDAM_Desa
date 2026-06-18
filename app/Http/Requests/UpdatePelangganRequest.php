<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelangganRequest extends FormRequest
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
            'nama' => ['required', 'max:255'],
            'alamat' => ['required'],
            'no_hp' => ['required', 'max:20'],
            'golongan_id' => ['required', 'exists:golongan_tarif,id'],
            'status' => ['required', 'in:aktif,nonaktif,diputus'],
            'user_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
