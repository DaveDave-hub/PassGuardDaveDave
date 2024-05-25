<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function changePass(Request $request)
    {
        // Validate the request
        $request->validate(['password' => 'required|min:6|confirmed']);
        $user = User::findOrFail(auth()->user()->id);
        // Check if authenticated user is authorized to change password for the user
        if ($user->update(['password' => bcrypt($request->input('password'))])) {
            // Redirect back or show a success message
            return redirect()->route('users.show', $user->id)->with('success', 'Password changed successfully.');
        }
        return redirect()->route('profile');
    }
}
