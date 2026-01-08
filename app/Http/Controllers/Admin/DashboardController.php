<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinPilot;
use App\Models\StayUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Check if admin is logged in via session
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }
        
        $joinPilotsCount = JoinPilot::count();
        $stayUpdatedCount = StayUpdated::count();
        $recentJoinPilots = JoinPilot::orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact('joinPilotsCount', 'stayUpdatedCount', 'recentJoinPilots'));
    }
    
    public function joinPilots(Request $request)
    {
        // Check if admin is logged in via session
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }
        
        $joinPilots = JoinPilot::orderBy('created_at', 'desc')->get();
        
        return view('admin.join-pilots', compact('joinPilots'));
    }
    
    public function stayUpdated(Request $request)
    {
        // Check if admin is logged in via session
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }
        
        $stayUpdatedList = StayUpdated::orderBy('created_at', 'desc')->get();
        
        return view('admin.stay-updated', compact('stayUpdatedList'));
    }
    
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        
        $adminUsername = config('admin.username');
        $adminPassword = config('admin.password');
        
        if ($username === $adminUsername && $password === $adminPassword) {
            // Simple session-based login
            session(['admin_logged_in' => true]);
            return redirect('/admin/dashboard');
        }
        
        return redirect('/admin/login')->with('error', 'Invalid credentials');
    }
    
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login.form');
    }
    
    public function showLoginForm()
    {
        return view('admin.login');
    }
    
    public function deleteJoinPilot($id)
    {
        // Check if admin is logged in via session
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }
        
        $application = JoinPilot::find($id);
        
        if ($application) {
            $application->delete();
            return response()->json(['success' => true, 'message' => 'Application deleted successfully']);
        }
        
        return response()->json(['success' => false, 'message' => 'Application not found'], 404);
    }
    
    public function deleteStayUpdated($id)
    {
        // Check if admin is logged in via session
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form');
        }
        
        $subscription = StayUpdated::find($id);
        
        if ($subscription) {
            $subscription->delete();
            return response()->json(['success' => true, 'message' => 'Subscription deleted successfully']);
        }
        
        return response()->json(['success' => false, 'message' => 'Subscription not found'], 404);
    }
}
