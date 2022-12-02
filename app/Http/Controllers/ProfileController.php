<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Profile;
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

        return view('profile.index');
    }

    public function show($profile_id) {
        $user = Account::findorfail($profile_id);

        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function edit_start()
    {
        return view('profile.edit');
    }

    public function update(Request $request) {
        $profile = Profile::where('account_id', $request->input('account_id'))->first();

        $is_renter = false;
        if ($request->has('in_renter')) {
            $is_renter = true;
        }

        if (is_null($profile)) {
            $profile = Profile::create([
                'account_id' => $request->input('account_id'),
                'is_renter' => $is_renter,
                'bio' => $request->input('in_bio'),
                'birthdate' => $request->input('in_birthdate'),
                'gender' => $request->input('in_gender')
            ]);

            return back();
        }

        $profile->is_renter = $is_renter;
        $profile->bio = $request->input('in_bio');
        $profile->birthdate = $request->input('in_birthdate');
        $profile->gender = $request->input('in_gender');

        $profile->save();

        return back();
    }
}
