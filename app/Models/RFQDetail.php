<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQDetail extends Model
{
    use HasFactory;

    protected $table = 'rfq_detail';

    protected $fillable = [
        'rfq_id',
        'nama_barang',
        'quantity',
        'spesifikasi',
    ];

    // Relasi ke RFQ
    public function rfq()
    {
        return $this->belongsTo(RFQ::class, 'rfq_id');
    }
}
