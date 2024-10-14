<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stand_id', 'base_url_id'];

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

}
