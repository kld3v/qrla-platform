<?php

namespace App\Legacy\Services;

use App\Legacy\Models\ShortUrl;
use Illuminate\Http\Request;
use App\Legacy\Models\ContactCard;
use Illuminate\Support\Facades\View;
use JeroenDesloovere\VCard\VCard;

class ShortUrlShowService {

    public function show(Request $request, $short_code)
    {
        $shortUrl = ShortUrl::byShortCode($short_code)->firstOrFail();

        if ($shortUrl->contactCard) {
            return $this->contactCardShow($short_code);
        }

        if ($shortUrl->status === 'rejected') {
            return view('link_terminated');
        } elseif ($shortUrl->status === 'pending') {
            $shortUrl->destination_url = 'https://qrla.io/page/pending';
        }

        if ($shortUrl->redirect && $shortUrl->redirect->redirectPreset) {
            $htmlPath = $shortUrl->redirect->redirectPreset->html_path;
            $filePath = base_path('app/Legacy/' . $htmlPath);
            $logoPath = $shortUrl->redirect->logo->path;

            return View::file($filePath, [
                'shortUrl' => $shortUrl,
                'logoPath' => $logoPath,
                'domain' => parse_url($shortUrl->destination_url, PHP_URL_HOST),
            ]);
        }
    }

    public function contactCardShow($short_code)
    {
        $contactCard = ContactCard::whereHas('shortUrl', function ($query) use ($short_code) {
            $query->where('short_code', $short_code);
        })->firstOrFail();

        $vcard = new VCard();
        $nameParts = explode(' ', $contactCard->name);
        $lastName = array_pop($nameParts);
        $firstName = implode(' ', $nameParts);
        $vcard->addName($lastName, $firstName);

        if ($contactCard->company) {
            $vcard->addCompany($contactCard->company);
        }
        if ($contactCard->position) {
            $vcard->addJobtitle($contactCard->position);
        }
        if ($contactCard->email) {
            $vcard->addEmail($contactCard->email);
        }
        if ($contactCard->website) {
            $vcard->addURL($contactCard->website);
        }
        if ($contactCard->phone_numbers && is_array($contactCard->phone_numbers)) {
            foreach ($contactCard->phone_numbers as $phone) {
                $type = strtoupper($phone['type']);
                $number = $phone['number'];

                if (!str_starts_with($number, '+44')) {
                    if (str_starts_with($number, '0')) {
                        $number = substr($number, 1);
                    }
                    $number = '+44' . $number;
                }

                $vcard->addPhoneNumber($number, $type);
            }
        }

        $vcardContent = base64_encode($vcard->getOutput());
        $filePath = base_path('app/Legacy/views/contact_cards/show.blade.php');

        return View::file($filePath, compact('contactCard', 'short_code', 'vcardContent'));
    }
}
