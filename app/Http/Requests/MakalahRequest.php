<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Judul_Artikel' => 'required|String',
            'Penulis' => 'required|String',
            'Nama_Seminar' => 'required|String',
            'Penyelenggara_Seminar' => 'required|String',
            'Waktu_Pelaksaaan' => 'required|String',
            'URL' => 'required|String'
        ];
    }
}
