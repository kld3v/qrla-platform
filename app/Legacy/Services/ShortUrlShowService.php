<?php

namespace App\Legacy\Services;

use App\Legacy\Models\ShortUrl;
use Illuminate\Http\Request;
use App\Legacy\Models\ContactCard;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class ShortUrlShowService {

    public function show(Request $request, $short_code)
    {   
        Log::info("ShortUrlShowService::show - Started", ['short_code' => $short_code]);

        $shortUrl = ShortUrl::byShortCode($short_code)->firstOrFail();
        Log::info("ShortUrlShowService::show - ShortUrl found", ['short_url_id' => $shortUrl->id]);

        if ($shortUrl->contactCard) {
            $shortUrl->destination_url = route('contact_cards.show', ['short_code' => $short_code]);
            Log::info("ShortUrlShowService::show - Contact card found, destination URL set", ['destination_url' => $shortUrl->destination_url]);
        }

        if ($shortUrl->status === 'rejected') {
            Log::info("ShortUrlShowService::show - Status is rejected, returning view.");
            return view('link_terminated');
        } elseif ($shortUrl->status === 'pending') {
            $shortUrl->destination_url = 'https://qrla.io/page/pending';
            Log::info("ShortUrlShowService::show - Status is pending, destination URL set to pending.");
        }

        if ($shortUrl->redirect && $shortUrl->redirect->redirectPreset) {
            $htmlPath = $shortUrl->redirect->redirectPreset->html_path;
            Log::info("ShortUrlShowService::show - Redirect preset found", ['html_path' => $htmlPath]);
            $filePath = base_path('app/Legacy/' . $htmlPath);
            Log::info("ShortUrlShowService::show - Full file path for view", ['file_path' => $filePath]);

            $logoPath = $shortUrl->redirect->logo->path;

            Log::info("ShortUrlShowService::show - Rendering view", [
                'short_url' => $shortUrl->id,
                'file_path' => $filePath,
                'logo_path' => $logoPath,
            ]);

            return View::file($filePath, [
                'shortUrl' => $shortUrl,
                'logoPath' => $logoPath,
                'domain' => parse_url($shortUrl->destination_url, PHP_URL_HOST),
            ]);
        }

        Log::info("ShortUrlShowService::show - No redirect preset found.");
    }

    public function contactCardShow($short_code)
    {
        Log::info("ShortUrlShowService::contactCardShow - Started", ['short_code' => $short_code]);

        $contactCard = ContactCard::whereHas('shortUrl', function ($query) use ($short_code) {
            $query->where('short_code', $short_code);
        })->firstOrFail();

        Log::info("ShortUrlShowService::contactCardShow - ContactCard found", ['contact_card_id' => $contactCard->id]);

        $filePath = base_path('app/Legacy/views/contact_cards/show.blade.php');
        Log::info("ShortUrlShowService::contactCardShow - Rendering view", ['file_path' => $filePath]);

        return View::file($filePath, compact('contactCard', 'short_code'));
    }
}
