<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required', 'max:255', 'min:2'],
            'fullname' =>  ['required', 'max:255', 'min:8'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id)],
            'tgl_lahir' => ['required'],
            'no_telp' => ['required'],
        ]);

        auth()->user()->update([
            'username' => $request->get('username'),
            'fullname' => $request->get('fullname'),
            'email' => $request->get('email'),
            'tgl_lahir' => $request->get('tgl_lahir'),
            'no_telp' => $request->get('no_telp'),
        ]);
        return back()->with('success', 'Profile successfully updated');
    }

    public function destroy()
{
    $user = auth()->user();

    // Handle related records in credit_bills table
    // Example: Delete related credit_bills records
    // Handle related records in the log table
    $user->log()->delete();
    $user->creditBills()->delete();
    $user->electricBills()->delete();
    $user->internetBills()->delete();

    // Now, you can safely delete the user
    $user->delete();

    return redirect()->route('home')->with('success', 'Akun berhasil dihapus.');
}


    // public function updateProfilePicture(Request $request)
    // {
    //     $request->validate([
    //         'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
    
    //     $user = Auth::user();
    
    //     // Delete old profile picture if exists
    //     if ($user->picture) {
    //         Storage::delete('profile_pictures/' . $user->picture);
    //     }
    
    //     // Store new profile picture
    //     $picturePath = $request->file('picture')->store('profile_pictures', 'private');
    //     $user->update(['picture' => basename($picturePath)]);
    
    //     return redirect()->back()->with('success', 'Profile picture updated successfully');
    // }

    public function updateProfilePicture(Request $request)
{
    $request->validate([
        'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust based on your requirements
    ]);

    if ($request->hasFile('picture')) {
        $image = $request->file('picture');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('img'), $imageName);

        auth()->user()->update(['picture' => $imageName]);

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }

    return redirect()->back()->with('error', 'Failed to update profile picture.');
}
    
}
    