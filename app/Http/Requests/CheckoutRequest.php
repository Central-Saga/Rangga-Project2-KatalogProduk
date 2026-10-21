<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            'customer_email' => ['nullable', 'email', 'max:150'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama pemesan wajib diisi.',
            'customer_name.max' => 'Nama pemesan maksimal 120 karakter.',
            'customer_phone.required' => 'Nomor HP/WhatsApp wajib diisi.',
            'customer_phone.regex' => 'Nomor HP hanya boleh berisi angka dan simbol + - ( ).',
            'customer_phone.max' => 'Nomor HP maksimal 25 karakter.',
            'customer_email.email' => 'Format email tidak valid.',
            'address.required' => 'Alamat pengiriman wajib diisi.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'notes.max' => 'Catatan maksimal 1000 karakter.',
        ];
    }
}
