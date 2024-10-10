<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id', 
        'path'
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }

}
