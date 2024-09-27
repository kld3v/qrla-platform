<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'base_url_id',
        'logo_id',
        'redirect_preset_id',
    ];
    
    public function baseUrl()
    {
        return $this->belongsTo(BaseUrl::class);
    }

    /**
     * Get the logo associated with the redirect.
     */
    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }

    /**
     * Get the preset associated with the redirect.
     */
    public function preset()
    {
        return $this->belongsTo(RedirectPreset::class, 'redirect_preset_id');
    }
}
