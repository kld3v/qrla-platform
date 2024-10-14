<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseUrl extends Model
{
    use HasFactory;
    
    protected $fillable = ['url'];

    public function redirect()
    {
        return $this->hasOne(Redirect::class);
    }

}
