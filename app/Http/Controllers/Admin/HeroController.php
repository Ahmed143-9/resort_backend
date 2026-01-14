<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    /**
     * Display the hero management page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $englishHero = Hero::where('language', 'en')->first();
        $bengaliHero = Hero::where('language', 'bn')->first();
        
        return view('admin.hero.index', compact('englishHero', 'bengaliHero'));
    }
    
    /**
     * Store or update hero data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'en_subtitle' => 'required|string|max:255',
            'en_title' => 'required|string',
            'en_description' => 'required|string',
            'bn_subtitle' => 'required|string|max:255',
            'bn_title' => 'required|string',
            'bn_description' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'en_is_active' => 'required|boolean',
            'bn_is_active' => 'required|boolean',
        ]);

        // Handle image upload if provided (shared for both languages)
        $imagePath = null;
        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $filename = Str::slug('hero-image') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('hero-images', $filename, 'public');
        }

        // Update or create English hero content
        $englishData = [
            'subtitle' => $request->en_subtitle,
            'title' => $request->en_title,
            'description' => $request->en_description,
            'is_active' => $request->en_is_active,
        ];
        
        if ($imagePath) {
            $englishData['background_image'] = $imagePath;
        }

        Hero::updateOrCreate(
            ['language' => 'en'],
            $englishData
        );

        // Update or create Bengali hero content
        $bengaliData = [
            'subtitle' => $request->bn_subtitle,
            'title' => $request->bn_title,
            'description' => $request->bn_description,
            'is_active' => $request->bn_is_active,
        ];
        
        if ($imagePath) {
            $bengaliData['background_image'] = $imagePath; // Use same image for Bengali
        }

        Hero::updateOrCreate(
            ['language' => 'bn'],
            $bengaliData
        );

        return redirect()->back()->with('success', 'Content updated successfully for both languages!');
    }
}