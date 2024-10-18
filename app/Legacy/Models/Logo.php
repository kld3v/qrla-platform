<?php

namespace App\Legacy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\FetchBase64ImageService;

class Logo extends Model
{
    use HasFactory;

    protected $connection = 'legacy_mysql';

    protected $fillable = [
        'user_id', 
        'path'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function qrCodes()
    // {
    //     return $this->hasMany(QRCode::class);
    // }

    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }

    // public function fetchBase64Image(bool $shouldReturnBase64 = false): ?string
    // {
    //     if (!$shouldReturnBase64 || empty($this->path)) {
    //         return null;
    //     }
    
    //     $imageService = new FetchBase64ImageService();
    //     return $imageService->getBase64Image($this->path);
    // }
    
}
