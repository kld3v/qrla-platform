<?php

namespace App\Legacy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCard extends Model
{
    use HasFactory;

    protected $connection = 'legacy_mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_numbers',
        'position',
        'website',
        'short_url_id',
        'company', 
        'address',
        'picture_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_numbers' => 'array',
    ];

    /**
     * Get the user that owns the contact card.
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Get the short URL associated with the contact card.
     */
    public function shortUrl()
    {
        return $this->belongsTo(ShortUrl::class);
    }

    /**
     * Set the phone numbers attribute.
     *
     * @param  array  $value
     * @return void
     */
    public function setPhoneNumbersAttribute($value)
    {
        $this->attributes['phone_numbers'] = json_encode($value);
    }

    /**
     * Get the phone numbers attribute.
     *
     * @param  string  $value
     * @return array
     */
    public function getPhoneNumbersAttribute($value)
    {
        return json_decode($value, true);
    }
}
