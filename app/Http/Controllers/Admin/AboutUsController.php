<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Show the About Us management form
     */
    public function index()
    {
        $englishContent = AboutUs::where('language', 'en')->first();
        $banglaContent = AboutUs::where('language', 'bn')->first();
        
        return view('admin.about-us', compact('englishContent', 'banglaContent'));
    }
    
    /**
     * Update About Us content
     */
    public function update(Request $request)
    {
        $request->validate([
            'english_content' => 'required|string',
            'bangla_content' => 'required|string',
        ]);
        
        // Update or create English content
        AboutUs::updateOrCreate(
            ['language' => 'en'],
            [
                'content' => $request->english_content,
                'is_active' => true,
            ]
        );
        
        // Update or create Bangla content
        AboutUs::updateOrCreate(
            ['language' => 'bn'],
            [
                'content' => $request->bangla_content,
                'is_active' => true,
            ]
        );
        
        return redirect()->back()->with('success', 'About Us content updated successfully!');
    }
}
