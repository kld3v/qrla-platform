<?php

namespace App\Services;

use App\Models\Plaque;
use App\Models\Block;
use App\Models\Seat;

class PlaqueRedirectService
{
    public function getPlaqueByShortCode($short_code)
    {
        return Plaque::where('short_code', $short_code)
            ->with([
                'plaqueable' => function ($morphTo) {
                    $morphTo->morphWith([
                        Block::class => ['baseUrl.redirect.logo', 'baseUrl.redirect.preset'],
                        Seat::class => ['block.baseUrl.redirect.logo', 'block.baseUrl.redirect.preset'],
                    ]);
                },
            ])
            ->firstOrFail();
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
        if ($plaqueable instanceof Block) {
            $baseUrl = $plaqueable->baseUrl;
        } elseif ($plaqueable instanceof Seat) {
            $baseUrl = $plaqueable->block->baseUrl;
        } else {
            abort(404, 'Plaque type not supported.');
        }

        $redirect = $baseUrl->redirect;
        $logo = $redirect->logo;
        $logoPath = $logo ? $logo->path : null;
        $presetView = 'redirect_presets.' . $redirect->preset->file_name;

        return [
            'presetView' => $presetView,
            'logoPath' => $logoPath,
        ];
    }
}