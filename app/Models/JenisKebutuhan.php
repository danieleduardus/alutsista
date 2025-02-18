<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKebutuhan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kebutuhan';
    protected $fillable = ['jenis', 'status']; // Tambahkan 'status'

    // Scope untuk hanya mengambil data yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

