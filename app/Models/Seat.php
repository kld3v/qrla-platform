<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['block_id', 'row', 'seat_number'];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
    public function plaques()
    {
        return $this->morphMany(Plaque::class, 'plaqueable');
    }
}
