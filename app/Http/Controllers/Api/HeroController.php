<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    /**
     * Get hero data by language
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getHeroByLang(Request $request): JsonResponse
    {
        $lang = $request->query('lang', 'en');
        
        // First, try to get the active hero for the requested language
        $hero = Hero::where('language', $lang)
            ->where('is_active', true)
            ->first();
        
        if (!$hero) {
            // If no active hero for requested language, try to get any hero for that language
            $hero = Hero::where('language', $lang)->first();
        }
        
        if (!$hero) {
            // If no hero exists for requested language, return null to trigger fallback to translations
            return response()->json([
                'success' => true,
                'data' => null
            ], 200);
        }
        
        return response()->json([
            'success' => true,
            'data' => $hero
        ], 200);
    }
}