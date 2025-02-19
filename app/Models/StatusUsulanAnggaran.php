<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUsulanAnggaran extends Model
{
    use HasFactory;

    protected $table = 'status_usulan_anggaran';
    protected $fillable = ['status'];

    // Relasi ke Usulan Anggaran
    public function usulanAnggaran()
    {
        return $this->hasMany(UsulanAnggaran::class, 'status_id');
    }
}
