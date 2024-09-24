<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo', 'banner'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
