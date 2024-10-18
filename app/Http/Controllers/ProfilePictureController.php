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

    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('profile_picture');
        $path = $image->store('profile_pictures', 'public');

        $this->imageService->resizeImage(storage_path('app/public/' . $path), 300);

        $profilePicture = new ProfilePicture([
            'user_id' => auth()->id(),
            'image_path' => $path,
        ]);
        $profilePicture->save();

        return response()->json(['message' => 'Profile picture uploaded successfully', 'path' => $path], 200);
    }
}
