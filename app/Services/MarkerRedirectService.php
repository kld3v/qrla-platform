<?php

namespace App\Services;

use App\Models\Marker;
use App\Models\Block;
use App\Models\Seat;

class MarkerRedirectService
{
    public function getMarkerByShortCode($short_code)
    {
        return Marker::where('short_code', $short_code)
            ->with([
                'markerable' => function ($morphTo) {
                    $morphTo->morphWith([
                        Block::class => ['redirect.logo', 'redirect.preset'],
                        Seat::class => ['block.redirect.logo', 'block.redirect.preset'],
                    ]);
                },
            ])
            ->first();
    }

    public function buildDestinationUrl($markerable, $type)
    {
        if ($type === 'block') {
            $baseUrl = $markerable->redirect->baseUrl->url;
            $stand = $markerable->stand->name;
            $block = $markerable->name;
            return $baseUrl . "?stand=" . urlencode($stand) . "&block=" . urlencode($block);
        } elseif ($type === 'seat') {
            $block = $markerable->block;
            $baseUrl = $block->redirect->baseUrl->url;
            $stand = $block->stand->name;
            $blockName = $block->name;
            $row = $markerable->row;
            $seatNumber = $markerable->seat_number;
            return $baseUrl . "?stand=" . urlencode($stand) . "&block=" . urlencode($blockName) . "&row=" . urlencode($row) . "&seat=" . urlencode($seatNumber);
        } else {
            abort(404, 'Marker type not supported.');
        }
    }

    public function getRedirectData($markerable)
    {
        if ($markerable instanceof Block) {
            $redirect = $markerable->redirect;
        } elseif ($markerable instanceof Seat) {
            $redirect = $markerable->block->redirect;
        } else {
            abort(404, 'Marker type not supported.');
        }

        $logo = $redirect->logo;
        $logoPath = $logo ? $logo->path : null;
        $presetView = 'redirect_presets.' . $redirect->preset->file_name;

        return [
            'presetView' => $presetView,
            'logoPath' => $logoPath,
        ];
    }
}
