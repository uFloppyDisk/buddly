<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
     * Show the user's profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (is_null(Auth::user()->profile)) {
            return redirect()->route('profile.edit')
                ->with('status', [
                    'type' => 'error', 
                    'message' => 'You have not created a profile yet! Please create one now.'
                ]);
        }

        return view('profile');
    }

    public function edit_profile_get()
    {
        return view('profile.edit');
    }
}
