<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makalah extends Model
{
    use HasFactory;
    protected $fillable = ['Judul_Artikel', 'Penulis', 'Nama_Seminar', 'Penyelenggara_Seminar', 'Waktu_Pelaksaaan', 'URL'];
}
