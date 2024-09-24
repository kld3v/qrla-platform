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
        'management',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
