<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $organisation = auth()->user()->organisation;

        if (!$organisation) {
            return response()->json(['error' => 'Organisation not found'], 404);
        }

        $image = $request->file('logo');
        $path = $image->store('organisation_logos', 'public'); // Store in 'organisation_logos' folder in the public disk

        $this->imageService->resizeImage(storage_path('app/public/' . $path), 500); // Resize to max 500px

        $organisation->logo_path = $path;
        $organisation->save();

        return response()->json(['message' => 'Logo uploaded successfully', 'path' => $path], 200);
    }
}
