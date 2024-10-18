<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\ImageService;
use Inertia\Inertia;

class OrganisationController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function uploadLogo(Request $request)
    {
        try {
            $request->validate([
                'logo' => 'required|image|max:10240|dimensions:max_width=2500,max_height=2500',
            ]);

            $user = Auth::user();
            $organisation = $user->organisation;

            if (!$organisation) {
                return response()->json(['error' => 'Organisation not found'], 404);
            }

            $file = $request->file('logo');
            $filename = 'organisation_' . $organisation->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            $tempPath = sys_get_temp_dir() . '/' . $filename;
            $file->move(sys_get_temp_dir(), $filename);

            $this->imageService->resizeImage($tempPath, 250);

            $logoPath = 'platform/public/organisation_logos/' . $filename;

            Storage::disk('s3')->put($logoPath, file_get_contents($tempPath));

            unlink($tempPath);

            $logoUrl = Storage::disk('s3')->url($logoPath);

            $organisation->logo_path = $logoUrl;
            $organisation->save();

            return response()->json(['message' => 'Logo uploaded successfully', 'path' => $logoUrl], 200);

        } catch (\Exception $e) {
            Log::error('Error during organisation logo upload process:', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while uploading the logo.'], 500);
        }
    }
}
