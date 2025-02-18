<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $table = 'hak_akses'; // Nama tabel

    protected $fillable = ['hak_akses', 'status']; // Kolom yang bisa diisi
}

