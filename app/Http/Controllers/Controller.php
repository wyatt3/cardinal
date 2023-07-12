<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('index');
    }

    public function adminIndex()
    {
        return view('admin.index');
    }

    public function getAbout()
    {
        $about = Storage::get('public/about.txt');
        return response()->json($about);
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about' => 'required|string'
        ]);

        Storage::put('public/about.txt', $request->about);

        return response()->json([
            'message' => 'About updated successfully'
        ]);
    }

    public function updateMastHeadImage(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'image' => 'required|image'
        ]);

        $image = $request->file('image');
        $imageName = "img/hero$request->id.jpg";
        $image->storeAs('public', $imageName);

        return response()->json([
            'message' => 'Image uploaded successfully'
        ]);
    }
}
