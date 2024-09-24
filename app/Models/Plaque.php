<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plaque extends Model
{
    use HasFactory;

    protected $fillable = ['short_code', 'plaqueable'];

    public function plaqueable()
    {
        return $this->morphTo();
    }
}
