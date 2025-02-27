<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    // Display list of pegawai
    public function index()
    {

        return view('auth.registeruser');
    }


    // Store newly created user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // If validation fails, the code below will not execute, and Laravel will automatically redirect back to the form with errors.
        // To add a SweetAlert message for validation errors, you can use a session flash message in your blade template where the form is.
        // However, if you want to add a specific alert here when validation passes, you can do so like this:
        Alert::success('Validation Successful', 'All inputs are valid!');

        // Handle file upload for profil
        $profilPath = null;
        if ($request->hasFile('foto_profil')) {
            $profil = $request->file('foto_profil');
            $profilPath = time() . '_' . $profil->getClientOriginalName();
            $profil->move(public_path('uploads/profil'), $profilPath); // Save to public/uploads/profil directory
        }

        // Create user with role 'user'
        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'foto_profil' => $profilPath,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Alert::success('Success', 'Register successfully created!');
        return redirect()->route('loginuser.index');
    }

    // Show form for editing pegawai
    public function editprofile()
    {
        $auth = Auth::user();
        $profileuser = User::where('user_id', $auth->id)->firstOrFail();


        return view('pageweb.profil', compact('profileuser', 'auth'));
    }

    






    // Update 
    public function updateprofile(Request $request, $user_id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            'email' => 'nullable|email',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Find existing 
        $profileuser = User::findOrFail($user_id);
        $user = User::findOrFail($profileuser->user_id);

        // Handle file upload for profile image
        if ($request->hasFile('foto_profil')) {
            // Delete the old profile image if it exists
            if ($profileuser->foto_profil && file_exists(public_path('uploads/profil/' . $profileuser->foto_profil))) {
                unlink(public_path('uploads/profil/' . $profileuser->foto_profil));
            }

            // Upload new profile image
            $profil = $request->file('foto_profil');
            $profilPath = time() . '_' . $profil->getClientOriginalName();
            $profil->move(public_path('uploads/profil'), $profilPath);
        } else {
            $profilPath = $profileuser->foto_profil; // Keep the old file if no new file uploaded
        }

        // Update RegisterUser model
        $profileuser->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'foto_profil' => $profilPath,
        ]);

        // Update User model
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        Alert::success('Success', 'Profile user successfully updated!');
        return redirect()->route('profile.edit');
    }
}
