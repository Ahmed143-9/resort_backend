<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJoinPilotRequest;
use App\Models\JoinPilot;
use Illuminate\Http\JsonResponse;

class JoinPilotController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJoinPilotRequest $request): JsonResponse
    {
        $validated = $request->validated();
        
        $joinPilot = JoinPilot::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Join Pilot application submitted successfully',
            'data' => $joinPilot
        ], 201);
    }

    /**
     * Display a listing of the resource (for admin purposes).
     */
    public function index(): JsonResponse
    {
        $joinPilots = JoinPilot::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $joinPilots
        ]);
    }
}