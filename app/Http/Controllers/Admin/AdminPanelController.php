<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;


class AdminPanelController extends Controller
{
    public function show() {
        $recent_new_users = Account::limit(10)->orderBy('created_at')->get();

        return view('admin.home', [
            'db_recent_new_users' => $recent_new_users
        ]);
    }
}
