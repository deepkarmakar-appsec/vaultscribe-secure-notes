<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    public function upload()
    {
        return view('fileupload');
    }

    public function fileupload(Request $request)
    {
        // 1. Strict Input Validation
        $request->validate([
            'file' => [
                'required',
                'file',
                'image',
                'mimes:jpg,jpeg,webp',
                'mimetypes:image/jpeg,image/webp',
                'max:2048',
            ],
        ]);

        $file = $request->file('file');
        $filename = Str::uuid() . '.webp'; 
        $tempPath = $file->getRealPath();

        /*
        |--------------------------------------------------------------------------
        | Verify Image Structure (AppSec Layer)
        |--------------------------------------------------------------------------
        */
        if (!getimagesize($tempPath)) {
            return back()->withErrors([
                'file' => 'Invalid image structure detected.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Re-Encode Image using Native PHP GD functions (Library Bypass)
        |--------------------------------------------------------------------------
        */
        try {
            // Check image mime type
            $mime = getimagesize($tempPath)['mime'];

            // Native functions se image source create karein (Sanitization Layer)
            if ($mime == 'image/jpeg' || $mime == 'image/jpg') {
                $imageSource = imagecreatefromjpeg($tempPath);
            } elseif ($mime == 'image/webp') {
                $imageSource = imagecreatefromwebp($tempPath);
            } else {
                throw new \Exception('Unsupported image format for re-encoding.');
            }

            if (!$imageSource) {
                throw new \Exception('Failed to process image structure.');
            }

            // Output ko buffer mein capture karke WebP banayein
            ob_start();
            imagewebp($imageSource, null, 85); // 85 quality
            $encoded = ob_get_clean();

            // Memory free karein
            imagedestroy($imageSource);

        } catch (\Throwable $e) {
            Log::error('Native Image Re-encoding Failed: ' . $e->getMessage());

            return back()->withErrors([
                'file' => 'Image processing failed. Error: ' . $e->getMessage()
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Store File, Update DB & Cleanup Old Avatar
        |--------------------------------------------------------------------------
        */
        $user = auth()->user();
        $oldPhoto = $user->profile_photo;

        DB::transaction(function () use ($filename, $encoded, $user, $oldPhoto) {
            // ✅ Storage::disk('local') use kiya kyunki iska root config me app/private par map hai
           
Storage::disk('local')->put('uploads/' . $filename, $encoded);

            // Database record update
            $user->update([
                'profile_photo' => $filename
            ]);

            // ✅ Purani file clean karne ke liye bhi local disk call hogi
            if ($oldPhoto && Storage::disk('local')->exists('uploads/' . $oldPhoto)) {
                Storage::disk('local')->delete('uploads/' . $oldPhoto);
            }
        });

        return back()->with(
            'success',
            'Profile photo uploaded and secured successfully.'
        );
    }
}