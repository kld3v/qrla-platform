<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedirectPreset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'thumbnail',
        'file_name',
    ];

    /**
     * Get the redirects that use this preset.
     */
    public function redirects()
    {
        return $this->hasMany(Redirect::class, 'redirect_preset_id');
    }
}
