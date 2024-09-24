<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plaque;

class PlaqueController extends Controller
{
    public function redirectPlaque($short_code)
    {
        $plaque = Plaque::where('short_code', $short_code)->firstOrFail();

        // Get the related polymorphic model (either a block or seat)
        $plaqueable = $plaque->plaqueable;

        if ($plaque->plaqueable_type === 'block') {
            $baseUrl = $plaqueable->baseUrl->url;
            $stand = $plaqueable->stand->name;
            $block = $plaqueable->name;

            echo $baseUrl . "?stand=" . urlencode($stand) . "&block=" . urlencode($block);
        } elseif ($plaque->plaqueable_type === 'seat') {
            $block = $plaqueable->block;
            $baseUrl = $block->baseUrl->url;
            $stand = $block->stand->name;
            $blockName = $block->name;
            $row = $plaqueable->row;
            $seatNumber = $plaqueable->seat_number;

            echo $baseUrl . "?stand=" . urlencode($stand) . "&block=" . urlencode($blockName) . "&row=" . urlencode($row) . "&seat=" . urlencode($seatNumber);
        } else {
            abort(404, 'Plaque type not supported.');
        }
    }
}