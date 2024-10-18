<?php

namespace App\Legacy\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\FetchBase64ImageService;

class ShortUrl extends Model
{
    use HasFactory;

    protected $connection = 'legacy_mysql';

    protected $fillable = [
        'name', 
        'short_code', 
        'destination_url', 
        'qr_code_id', 
        'qr_code_type',
        'redirect_id', 
        'base_qr_code_image_path', 
        'user_id',
        'views',
        'status',
        'unique_identifier',
    ];

    protected $hidden = [
        'unique_identifier',
    ];

    // public function qrCode()
    // {
    //     return $this->belongsTo(QrCode::class);
    // }

    public function redirect()
    {
        return $this->belongsTo(Redirect::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function accessLogs()
    // {
    //     return $this->hasMany(AccessLog::class);
    // }

    public function contactCard()
    {
        return $this->hasOne(ContactCard::class);
    }

    public function scopeByShortCode($query, $shortCode)
    {
        return $query->where('short_code', $shortCode);
    }

    // public function fetchBase64Image(bool $shouldReturnBase64 = false): ?string
    // {
    //     if (!$shouldReturnBase64 || empty($this->base_qr_code_image_path)) {
    //         return null;
    //     }
    
    //     $imageService = new FetchBase64ImageService();
    //     return $imageService->getBase64Image($this->base_qr_code_image_path);
    // }

}
