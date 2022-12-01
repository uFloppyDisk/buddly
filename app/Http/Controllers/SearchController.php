<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {
        $users = Account::where('type', '<>', 255)->inRandomOrder()->get();

        return view('search', [
            'db_users' => $users
        ]);
    }
}
