<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusVendor extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'status_id');
    }
}
