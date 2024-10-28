<?php

namespace App\Http\Controllers;

use App\Services\MarkerRedirectService;
use App\Legacy\Services\ShortUrlShowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            
            Log::info("Marker found, {$marker}");

            return view($redirectData['presetView'], [
                'destination_url' => $destinationUrl,
                'logoPath' => $redirectData['logoPath'],
                'domain' => parse_url($destinationUrl, PHP_URL_HOST),
            ]);
        }
    
        Log::info("Marker not found, attempting legacy lookup with ShortUrlShowService for short_code: {$short_code}");
    
        try {
            return $this->shortUrlShowService->show(request(), $short_code);
        } catch (\Exception $e) {
            Log::error("Legacy lookup failed for short code: {$short_code}", ['exception' => $e]);
            return abort(404, 'Short code not found.');
        }
    }

    public function testShortUrlShow($short_code)
    {
        Log::info("Testing ShortUrlShowService for short_code: {$short_code}");

        try {
            return $this->shortUrlShowService->show(request(), $short_code);
        } catch (\Exception $e) {
            Log::error("ShortUrlShowService test failed for short_code: {$short_code}", ['exception' => $e]);
            return response()->json(['error' => 'Short code not found or service failure.'], 404);
        }
    }

}
