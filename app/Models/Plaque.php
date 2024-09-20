<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaque extends Model
{
    use HasFactory;

    protected $fillable = ['seat_id', 'block_id', 'short_code'];

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
