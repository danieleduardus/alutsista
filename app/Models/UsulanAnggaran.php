<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UsulanAnggaran extends Model
{
    use HasFactory;

    protected $table = 'usulan_anggaran';

    protected $fillable = [
        'nomor',
        'judul',
        'jumlah',
        'realisasi',
        'status_id'
    ];

    /**
     * Relasi ke Rencana Kebutuhan (One-to-Many).
     */
    public function rencanaKebutuhan()
    {
        return $this->belongsToMany(RencanaKebutuhan::class, 'rencana_kebutuhan_usulan_anggaran', 'usulan_anggaran_id', 'rencana_kebutuhan_id');
    }


    // Relasi ke Status Usulan Anggaran
    public function status()
    {
        return $this->belongsTo(StatusUsulanAnggaran::class, 'status_id');
    }
}

