<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return response()->json($services);
    }

    public function updateService(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:services,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $service = Service::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image',
            ]);
            // Save image
            $path = "path/to/image";
        }

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path ?? $service->image,
        ]);
    }

    public function updateServiceOrder(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:services,id',
            'order' => 'required|integer',
        ]);

        $service = Service::findOrFail($request->id);
        $service->update(['order' => $request->order]);

        return response()->json($service);
    }
}
