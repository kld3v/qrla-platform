<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueRegisterLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'role',
        'organisation_id',
        'venue_ids',
        'expires_at',
    ];

    protected $casts = [
        'venue_ids' => 'array',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the organisation associated with the unique link.
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
}
