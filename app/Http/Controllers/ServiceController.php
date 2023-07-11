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
