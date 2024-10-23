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
            Log::info('Logo upload initiated', ['user_id' => Auth::id()]);

            $request->validate([
                'logo' => 'required|image|max:10240|dimensions:max_width=2500,max_height=2500',
            ]);
            Log::info('Logo validation passed.');

            $user = Auth::user();
            $organisation = $user->organisation;

            if (!$organisation) {
                Log::warning('Organisation not found', ['user_id' => $user->id]);
                return response()->json(['error' => 'Organisation not found'], 404);
            }

            Log::info('Organisation found', ['organisation_id' => $organisation->id]);

            $file = $request->file('logo');
            $filename = 'organisation_' . $organisation->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            Log::info('File received', ['filename' => $filename]);

            $tempPath = sys_get_temp_dir() . '/' . $filename;
            $file->move(sys_get_temp_dir(), $filename);
            Log::info('File moved to temporary path', ['temp_path' => $tempPath]);

            $this->imageService->resizeImage($tempPath, 250);
            Log::info('Image resized', ['temp_path' => $tempPath]);

            $logoPath = 'platform/public/organisation_logos/' . $filename;
            Storage::disk('s3')->put($logoPath, file_get_contents($tempPath));
            Log::info('File uploaded to S3', ['s3_path' => $logoPath]);

            unlink($tempPath);
            Log::info('Temporary file deleted', ['temp_path' => $tempPath]);

            $logoUrl = Storage::disk('s3')->url($logoPath);
            Log::info('Generated S3 URL', ['logo_url' => $logoUrl]);

            $organisation->logo_path = $logoUrl;
            $organisation->save();
            Log::info('Organisation logo path updated', ['organisation_id' => $organisation->id]);

            return response()->json(['message' => 'Logo uploaded successfully', 'path' => $logoUrl], 200);

        } catch (\Exception $e) {
            Log::error('Error during organisation logo upload process:', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred while uploading the logo.'], 500);
        }
    }
}
