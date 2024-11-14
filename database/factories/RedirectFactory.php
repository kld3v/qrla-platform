<?php

namespace Database\Factories;

use App\Legacy\Models\RedirectPreset;
use App\Models\BaseUrl;
use App\Models\Logo;
use App\Models\Redirect;
use App\Models\RedirectPreset as ModelsRedirectPreset;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedirectFactory extends Factory
{
    protected $model = Redirect::class;

    public function definition()
    {
        return [
            'base_url_id' => BaseUrl::factory(),
            'logo_id' => Logo::factory(),
            'redirect_preset_id' => ModelsRedirectPreset::factory(),
        ];
    }
}