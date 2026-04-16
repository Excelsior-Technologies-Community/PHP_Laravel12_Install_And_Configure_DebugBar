<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserActivity;
use App\Models\Download;

class HomeController extends Controller
{
    /**
     * Show the dashboard/home page
     */
    public function index()
    {
        // Log user activity if logged in
        if (Auth::check()) {
            UserActivity::create([
                'user_id' => Auth::id(),
                'activity' => 'Visited Dashboard',
                'ip_address' => request()->ip(),
            ]);
        }

        // Get download count for test.pdf
        $download = Download::where('file_name', 'test.pdf')->first();
        $downloadCount = $download ? $download->count : 0;

        return view('home', compact('downloadCount'));
    }

    /**
     * Handle PDF download and increment counter
     */
    public function downloadFile($file)
    {
        $filePath = public_path('files/' . $file);

        if (!file_exists($filePath)) {
            abort(404, "File not found: $file");
        }

        // Increment download count
        $download = Download::firstOrCreate(
            ['file_name' => $file],
            ['count' => 0]
        );
        $download->increment('count');

        return response()->download($filePath);
    }
}