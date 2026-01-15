<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AboutUsController extends Controller
{
    /**
     * Get about us content by language
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAboutByLang(Request $request): JsonResponse
    {
        $lang = $request->query('lang', 'en');
        
        // Validate language parameter
        if (!in_array($lang, ['en', 'bn'])) {
            $lang = 'en';
        }
        
        // Get the active about us content for the requested language
        $about = AboutUs::where('language', $lang)
            ->where('is_active', true)
            ->first();
        
        if (!$about) {
            // Return null to trigger fallback to translations
            return response()->json([
                'success' => true,
                'data' => null
            ], 200);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'content' => $about->content
            ]
        ], 200);
    }

// Other CRUD methods can be added here for admin panel
}
