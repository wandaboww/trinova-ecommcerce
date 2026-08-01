<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'company'         => ['nullable', 'string', 'max:255'],
            'phone'           => ['required', 'string', 'max:20'],
            'email'           => ['nullable', 'email', 'max:255'],
            'business_type'   => ['required', 'string', 'max:255'],
            'marketplace'     => ['required', 'string', 'max:255'],
            'monthly_revenue' => ['required', 'string', 'max:100'],
            'team_size'       => ['nullable', 'string', 'max:100'],
            'message'         => ['required', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'            => 'Nama wajib diisi.',
            'phone.required'           => 'Nomor WhatsApp wajib diisi.',
            'business_type.required'   => 'Jenis bisnis wajib dipilih.',
            'marketplace.required'     => 'Platform marketplace wajib dipilih.',
            'monthly_revenue.required' => 'Estimasi omzet wajib dipilih.',
            'message.required'         => 'Masalah utama bisnis wajib diisi.',
        ];
    }
}
