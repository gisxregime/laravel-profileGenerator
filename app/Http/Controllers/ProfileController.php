<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   
    public function index()
    {
        $profiles = Profile::query()->latest()->get();

        return view('index', [
            'profiles' => $profiles,
            'message' => request()->query('message'),
        ]);
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'age'       => 'required|integer|min:1|max:120',
            'program'   => 'required|string|max:100',
            'email'     => 'required|email|max:150',
            'gender'    => 'required|in:Male,Female',
            'hobbies'   => 'required|array|min:5',
            'hobbies.*' => 'string',
            'biography' => 'nullable|string|max:500',
        ], [
            'hobbies.min' => 'Please select at least 5 hobbies.',
        ]);

        Profile::query()->create([
            'name'      => $validated['name'],
            'age'       => $validated['age'],
            'program'   => $validated['program'],
            'email'     => $validated['email'],
            'gender'    => $validated['gender'],
            'hobbies'   => $validated['hobbies'],
            'biography' => $validated['biography'] ?? '',
        ]);

        $message = urlencode('Profile for "' . $validated['name'] . '" has been saved!');

        return redirect('/?message=' . $message);
    }

    
    public function clearAll()
    {
        Profile::query()->delete();

        return redirect('/?message=' . urlencode('All profiles have been deleted.'));
    }
}
