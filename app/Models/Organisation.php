<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_line1',
        'city',
        'country',
        'postcode',
        'contact_email',
        'contact_phone',
        'logo_path'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }
}
