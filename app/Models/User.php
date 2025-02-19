<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'hak_akses_id'
    ];

    /**
     * Relasi ke model HakAkses.
     */
    public function hakAkses(): BelongsTo
    {
        return $this->belongsTo(HakAkses::class, 'hak_akses_id');
    }
}
