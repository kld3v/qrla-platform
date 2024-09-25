<?php

namespace App\Http\Controllers;

use App\Services\PlaqueRedirectService;
use Illuminate\Http\Request;

class PlaqueController extends Controller
{
    protected $plaqueRedirectService;

    public function __construct(PlaqueRedirectService $plaqueRedirectService)
    {
        $this->plaqueRedirectService = $plaqueRedirectService;
    }

    public function redirectPlaque($short_code)
    {
        $plaque = $this->plaqueRedirectService->getPlaqueByShortCode($short_code);
        $plaqueable = $plaque->plaqueable;

        $destinationUrl = $this->plaqueRedirectService->buildDestinationUrl($plaqueable, $plaque->plaqueable_type);

        $redirectData = $this->plaqueRedirectService->getRedirectData($plaqueable);

        return view($redirectData['presetView'], [
            'destination_url' => $destinationUrl,
            'logoPath' => $redirectData['logoPath'],
            'domain' => parse_url($destinationUrl, PHP_URL_HOST),
        ]);
    }
}
