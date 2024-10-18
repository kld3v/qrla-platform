<?php

namespace App\Legacy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{

    protected $connection = 'legacy_mysql';
    
    protected $fillable = [
        'redirect_preset_id', 
        'logo_id', 
        'user_id',
        'color'
    ];

    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }

    public function redirectPreset()
    {
        return $this->belongsTo(RedirectPreset::class);
    }

    public function shortUrl()
    {
        return $this->hasOne(ShortUrl::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
