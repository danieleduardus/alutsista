<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusRFQ extends Model
{
    use HasFactory;

    protected $table = 'status_rfq';
    protected $fillable = ['status'];

    public function rfqs()
    {
        return $this->hasMany(RFQ::class, 'status_id');
    }
}
