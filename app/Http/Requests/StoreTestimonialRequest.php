<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan testimoni wajib diisi.',
            'message.min' => 'Pesan testimoni minimal 10 karakter.',
            'message.max' => 'Pesan testimoni maksimal 1000 karakter.',
            'rating.required' => 'Rating wajib dipilih.',
            'rating.between' => 'Rating harus antara 1 sampai 5.',
        ];
    }
}
