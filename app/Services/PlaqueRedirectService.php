<?php


namespace App\Services;

use App\Models\Plaque;

class PlaqueRedirectService
{
    public function getPlaqueByShortCode($short_code)
    {
        return Plaque::where('short_code', $short_code)->firstOrFail();
    }

    public function buildDestinationUrl($plaqueable, $type)
    {
        if ($type === 'block') {
            $baseUrl = $plaqueable->baseUrl->url;
            $stand = $plaqueable->stand->name;
            $block = $plaqueable->name;
            return $baseUrl . "?stand=" . urlencode($stand) . "&block=" . urlencode($block);
        } elseif ($type === 'seat') {
            $block = $plaqueable->block;
            $baseUrl = $block->baseUrl->url;
            $stand = $block->stand->name;
            $blockName = $block->name;
            $row = $plaqueable->row;
            $seatNumber = $plaqueable->seat_number;
            return $baseUrl . "?stand=" . urlencode($stand) . "&block=" . urlencode($blockName) . "&row=" . urlencode($row) . "&seat=" . urlencode($seatNumber);
        } else {
            abort(404, 'Plaque type not supported.');
        }
    }

    public function getRedirectData($plaqueable)
    {
        $redirect = $plaqueable->baseUrl->redirect;
        $logo = $redirect->logo;
        $logoPath = $logo ? $logo->path : null;
        $presetView = 'redirect_presets.' . $redirect->preset->file_name;

        return [
            'presetView' => $presetView,
            'logoPath' => $logoPath,
        ];
    }
}
