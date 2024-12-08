<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255', // Nama pengguna harus diisi, berupa string, dan maksimum 255 karakter
            'email' => 'required|string|email|max:255|unique:users', // Email harus diisi, unik dalam tabel users, dan format email yang valid
            'password' => 'required|string|min:8|confirmed', // Kata sandi harus diisi, minimal 8 karakter, dan harus sesuai dengan konfirmasi
        ];
    }

    /**
     * Get custom validation messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama pengguna wajib diisi.',
            'name.string' => 'Nama pengguna harus berupa teks.',
            'name.max' => 'Nama pengguna tidak boleh lebih dari :max karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
            'password.min' => 'Kata sandi harus terdiri dari minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk mengakses permintaan ini
    }
}
