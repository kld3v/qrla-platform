<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stand_id', 
        'base_url_id',
        'plaques',
        'access_rate'
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }

    public function baseUrl()
    {
        return $this->belongsTo(BaseUrl::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function markers()
    {
        return $this->morphMany(Marker::class, 'markerable');
    }

    public function accessCounts()
    {
        return $this->morphMany(AccessCount::class, 'countable');
    }

    public function seatAccessCounts()
    {
        return $this->accessCounts()->where('marker_type', 'seat');
    }

    public function blockAccessCounts()
    {
        return $this->accessCounts()->where('marker_type', 'block');
    }
    
    public function totalAccessCounts()
    {
        $seatCount = $this->seatAccessCounts()->sum('total_count');
        $blockCount = $this->blockAccessCounts()->sum('total_count');
        return $seatCount + $blockCount;
    }

}
