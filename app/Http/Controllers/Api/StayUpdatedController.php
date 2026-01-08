<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStayUpdatedRequest;
use App\Models\StayUpdated;
use Illuminate\Http\JsonResponse;

class StayUpdatedController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStayUpdatedRequest $request): JsonResponse
    {
        $validated = $request->validated();
        
        $stayUpdated = StayUpdated::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Email subscription submitted successfully',
            'data' => $stayUpdated
        ], 201);
    }

    /**
     * Display a listing of the resource (for admin purposes).
     */
    public function index(): JsonResponse
    {
        $stayUpdated = StayUpdated::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $stayUpdated
        ]);
    }
}