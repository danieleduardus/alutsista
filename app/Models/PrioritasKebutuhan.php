<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrioritasKebutuhan extends Model
{
    use HasFactory;

    protected $table = 'prioritas_kebutuhan';
    protected $fillable = ['prioritas'];

    // Relasi ke RencanaKebutuhan (One-to-Many)
    public function rencanaKebutuhan()
    {
        return $this->hasMany(RencanaKebutuhan::class, 'prioritas_id');
    }
}
