<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'address_line1',
        'city',
        'country',
        'postcode',
        'type',
        'logo_url',
        'banner_url',
        'capacity',
        'status',
        'short_description',
        'long_description',
        'contact_email',
        'contact_phone',
        'organisation_id',
        'plaques',
        'access_rate',
        'map_svg_url'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'venue_user');
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
    
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function redirect()
    {
        return $this->hasOne(Redirect::class);
    }

    public function logos()
    {
        return $this->hasMany(Logo::class);
    }

    public function stands()
    {
        return $this->hasMany(Stand::class);
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
