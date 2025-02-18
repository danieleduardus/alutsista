<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrioritasKebutuhan extends Model
{
    use HasFactory;

    protected $table = 'prioritas_kebutuhan';
    protected $fillable = ['prioritas', 'status']; // Tambahkan 'status'

    // Scope untuk hanya mengambil data yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
