<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
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
        

        $path = $image->store('organisation_logos', 's3'); 
    
        $localPath = storage_path('app/' . $path); 
        $this->imageService->resizeImage($localPath, 500); 

        Storage::disk('s3')->put($path, file_get_contents($localPath));
    
        $organisation->logo_path = $path;
        $organisation->save();
    
        return response()->json(['message' => 'Logo uploaded successfully', 'path' => $path], 200);
    }
    
}
