<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'venue_id'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
