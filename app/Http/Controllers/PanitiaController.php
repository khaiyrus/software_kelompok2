<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{
    public function index()
    {
        return view('panitia.dashboard');
    }
    public function user()
    {
        $user = user::all();
        return view('panitia.user', compact('user'));
    }
}
