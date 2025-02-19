<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaKebutuhan extends Model
{
    use HasFactory;

    protected $table = 'rencana_kebutuhan';
    protected $fillable = ['nomor', 'judul', 'deskripsi', 'jenis_kebutuhan_id', 'prioritas_id', 'usulan_anggaran_id'];

    // Relasi ke JenisKebutuhan (Many-to-One)
    public function jenisKebutuhan()
    {
        return $this->belongsTo(JenisKebutuhan::class, 'jenis_kebutuhan_id');
    }

    // Relasi ke PrioritasKebutuhan (Many-to-One)
    public function prioritasKebutuhan()
    {
        return $this->belongsTo(PrioritasKebutuhan::class, 'prioritas_id');
    }

    /**
     * Relasi ke Usulan Anggaran (Many-to-One).
     */
    public function usulanAnggaran(): BelongsTo
    {
        return $this->belongsTo(UsulanAnggaran::class, 'usulan_anggaran_id');
    }
}
