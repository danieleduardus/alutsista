<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQ extends Model
{
    use HasFactory;

    protected $table = 'rfq';

    protected $fillable = [
        'usulan_anggaran_id',
        'tanggal_batas_pemenuhan',
        'catatan_pengiriman',
    ];

    protected $attributes = [
        'status_id' => 1, // Default status_id adalah 1
    ];
    

    // Relasi ke Usulan Anggaran
    public function usulanAnggaran()
    {
        return $this->belongsTo(UsulanAnggaran::class, 'usulan_anggaran_id');
    }

    public function details()
    {
        return $this->hasMany(RFQDetail::class, 'rfq_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusRFQ::class, 'status_id');
    }


}
