<?php

namespace App\Services;

use App\Models\Venue;
use App\Models\Stand;
use App\Models\Block;
use App\Models\Seat;
use App\Models\BaseUrl;
use App\Models\Marker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class VenueOnboardingService
{
    public function onboardVenue(array $venueData, string $filePath)
    {
        DB::transaction(function () use ($venueData, $filePath) {
            $baseUrl = BaseUrl::firstOrCreate(['url' => $venueData['base_url']]);

            $venue = Venue::create($venueData);

            $dataRows = $this->readExcelFile($filePath);

            foreach ($dataRows as $row) {
                $standName = $row['Stand'];
                $blockName = $row['Block'];
                $rowName   = $row['Row'];
                $seatNumber= $row['Seat Number'];

                $stand = Stand::firstOrCreate(
                    ['name' => $standName, 'venue_id' => $venue->id]
                );

                $block = Block::firstOrCreate(
                    [
                        'name'       => $blockName,
                        'stand_id'   => $stand->id,
                    ],
                    [
                        'base_url_id' => $baseUrl->id,
                    ]
                );

                if ($block->base_url_id !== $baseUrl->id) {
                    $block->base_url_id = $baseUrl->id;
                    $block->save();
                }

                if (!$block->markers()->exists()) {
                    $this->createUniqueMarker($block);
                }

                $seat = Seat::firstOrCreate(
                    [
                        'block_id'    => $block->id,
                        'row'         => $rowName,
                        'seat_number' => $seatNumber,
                    ]
                );

                if (!$seat->markers()->exists()) {
                    $this->createUniqueMarker($seat);
                }
            }
        });
    }

    protected function readExcelFile($filePath)
    {
        $fullPath = Storage::path($filePath);

        $data = Excel::toArray([], $fullPath);

        $rows = array_filter($data[0], function ($row) {
            return array_filter($row);
        });

        $header = array_shift($rows);
        $mappedData = array_map(function ($row) use ($header) {
            return array_combine($header, $row);
        }, $rows);

        return $mappedData;
    }

    protected function createUniqueMarker($model)
    {
        do {
            $shortCode = Str::random(8);
            $exists = Marker::where('short_code', $shortCode)->exists();
        } while ($exists);

        $model->markers()->create([
            'short_code' => $shortCode,
        ]);
    }
}
