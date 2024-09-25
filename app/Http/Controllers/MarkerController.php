<?php

namespace App\Http\Controllers;

use App\Services\MarkerRedirectService;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    protected $markerRedirectService;

    public function __construct(MarkerRedirectService $markerRedirectService)
    {
        $this->markerRedirectService = $markerRedirectService;
    }

    public function redirectMarker($short_code)
    {
        $marker = $this->markerRedirectService->getMarkerByShortCode($short_code);
        $markerable = $marker->markerable;

        $destinationUrl = $this->markerRedirectService->buildDestinationUrl($markerable, $marker->markerable_type);

        $redirectData = $this->markerRedirectService->getRedirectData($markerable);

        return view($redirectData['presetView'], [
            'destination_url' => $destinationUrl,
            'logoPath' => $redirectData['logoPath'],
            'domain' => parse_url($destinationUrl, PHP_URL_HOST),
        ]);
    }
}
