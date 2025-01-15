<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Display the list of users.
     */
    public function index()
    {
        // Retrieve all users
        $users = User::all();

        // Pass users to the view
        return view('users.view', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|confirmed|min:8',
        ], [
            'name.required' => 'The username is required.',
            'name.unique' => 'The username is already taken. Please choose a different one.',
            'password.required' => 'The password is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirect with success message
        return redirect()->route('users.view')->with('success', 'User created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id): View
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:users,name,$id"],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ], [
            'name.required' => 'The username is required.',
            'name.unique' => 'The username is already taken. Please choose a different one.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        $user = User::findOrFail($id);

        // Update user details
        $user->name = $validatedData['name'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        // Redirect with success message
        return redirect()->route('users.view')->with('success', 'User profile updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $currentUser = Auth::id();

        if ($currentUser == $id) {
            return redirect()->route('users.view')->with('error', 'You cannot delete your own account.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.view')->with('success', 'User deleted successfully.');
    }
}
