<?php

namespace App\Http\Controllers;

use App\Services\MarkerRedirectService;
use App\Legacy\Services\ShortUrlShowService;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    protected $markerRedirectService;
    protected $shortUrlShowService;

    public function __construct(MarkerRedirectService $markerRedirectService, ShortUrlShowService $shortUrlShowService)
    {
        $this->markerRedirectService = $markerRedirectService;
        $this->shortUrlShowService = $shortUrlShowService;
    }

    public function handleMarkerRedirect($short_code)
    {
        $marker = $this->markerRedirectService->getMarkerByShortCode($short_code);

        if ($marker) {
            $markerable = $marker->markerable;

            $destinationUrl = $this->markerRedirectService->buildDestinationUrl($markerable, $marker->markerable_type);

            $redirectData = $this->markerRedirectService->getRedirectData($markerable);

            return view($redirectData['presetView'], [
                'destination_url' => $destinationUrl,
                'logoPath' => $redirectData['logoPath'],
                'domain' => parse_url($destinationUrl, PHP_URL_HOST),
            ]);
        }

        try {
            return $this->shortUrlShowService->show(request(), $short_code);
        } catch (\Exception $e) {
            \Log::channel('legacy')->error("Legacy lookup failed for short code: {$short_code}", ['exception' => $e]);
            return abort(404, 'Short code not found.');
        }
    }
}
