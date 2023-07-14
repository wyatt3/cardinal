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
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $service = Service::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image',
            ]);
            $path = $service->getKey() . '.jpg';
            $request->image->storeAs('public/img', $path);
        }

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path ?? $service->image,
        ]);
        return response()->json($service);
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
