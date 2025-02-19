<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $table = 'hak_akses';

    protected $fillable = [
        'hak_akses', 
        'status',
        'menu_master_data',
        'menu_rencana_kebutuhan',
        'menu_usulan_anggaran',
        'menu_rfq',
        'menu_kontrak',
        'mengelola_master_data',
        'membuat_rencana_kebutuhan',
        'menentukan_prioritas_rencana_kebutuhan',
        'membuat_usulan_anggaran',
        'mengubah_usulan_anggaran',
        'menyetujui_usulan_anggaran',
        'membuat_rfq',
        'mengubah_rfq',
        'menyetujui_dan_mempublikasikan_rfq',
        'memilih_vendor_dan_penawaran',
        'menandatangani_kontrak'
    ];

    /**
     * Relasi ke model User (satu hak akses bisa digunakan oleh banyak pengguna).
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'hak_akses_id');
    }
}
