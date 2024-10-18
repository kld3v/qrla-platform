<?php

namespace App\Legacy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class RedirectPreset extends Model
{
    use HasFactory;

    protected $connection = 'legacy_mysql';

    protected $fillable = [
        'name',
        'path', 
        'html_path'
    ];
    
    protected $appends = ['html_content'];
    
    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }

    public function getHtmlContentAttribute()
    {
        $filePath = resource_path($this->html_path);

        if (File::exists($filePath)) {
            return File::get($filePath);
        }

        return null;
    }
}
