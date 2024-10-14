<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'countable_type',
        'countable_id',
        'marker_type',
        'total_count',
    ];

    public function countable()
    {
        return $this->morphTo();
    }
}
