<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
   
    public function index()
    {
        $profiles = session('profiles', []);
        return view('index', compact('profiles'));
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

        $profiles = session('profiles', []);

        $profiles[] = [
            'name'      => $validated['name'],
            'age'       => $validated['age'],
            'program'   => $validated['program'],
            'email'     => $validated['email'],
            'gender'    => $validated['gender'],
            'hobbies'   => $validated['hobbies'],
            'biography' => $validated['biography'] ?? '',
        ];

        session(['profiles' => $profiles]);

        return redirect('/')->with('success', 'Profile for "' . $validated['name'] . '" has been saved!');
    }

    
    public function clearAll()
    {
        session()->forget('profiles');
        return redirect('/')->with('success', 'All profiles have been deleted.');
    }
}
