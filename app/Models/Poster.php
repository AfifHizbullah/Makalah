<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $fillable = [
        'Judul_Artikel',
        'Penulis',
        'Nama_Seminar',
        'Penyelenggara_Seminar',
        'Waktu_Pelaksaaan',
        'ISBN_ISSN',
        'URL',
        //'user_id' // Tambahkan kolom user_id untuk relasi
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Menambahkan relasi dengan model User
    }
}
