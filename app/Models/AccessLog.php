<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'marker_id',
        'ip_address',
        'user_agent',
        'os',
        'device',
        'country',
        'browser',
        'language',
        'referrer',
        'accessed_at',
    ];

    protected $casts = [
        'accessed_at' => 'datetime',
    ];
    
    public function marker()
    {
        return $this->belongsTo(Marker::class);
    }
}
