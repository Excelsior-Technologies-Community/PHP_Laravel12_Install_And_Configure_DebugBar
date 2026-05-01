<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\UserActivity;
use App\Models\Download;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            UserActivity::create([
                'user_id' => Auth::id(),
                'activity' => 'Visited Dashboard',
                'ip_address' => request()->ip(),
            ]);
        }

        $filesPath = public_path('files');
        $files = [];
        
        if (File::exists($filesPath)) {
            $allFiles = File::files($filesPath);
            foreach ($allFiles as $file) {
                $fileName = $file->getFilename();
                $downloadRecord = Download::where('file_name', $fileName)->first();
                $files[] = [
                    'name' => $fileName,
                    'count' => $downloadRecord ? $downloadRecord->count : 0
                ];
            }
        }

        return view('home', compact('files'));
    }

    public function downloadFile($file)
    {
        $safeFile = basename($file);
        $filePath = public_path('files/' . $safeFile);

        if (!File::exists($filePath)) {
            abort(404);
        }

        if (Auth::check()) {
            UserActivity::create([
                'user_id' => Auth::id(),
                'activity' => 'Downloaded: ' . $safeFile,
                'ip_address' => request()->ip(),
            ]);
        }

        $download = Download::firstOrCreate(
            ['file_name' => $safeFile],
            ['count' => 0]
        );
        $download->increment('count');

        return response()->download($filePath);
    }

    public function adminIndex()
    {
        $activities = UserActivity::latest()->get();
        $downloads = Download::all();
        $users = User::all();
        return view('admin.dashboard', compact('activities', 'downloads', 'users'));
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}