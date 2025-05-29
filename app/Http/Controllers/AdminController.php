<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function user()
    {
        return view('admin.user');
    }
    public function kandidat()
    {
        return view('admin.data_kandidat');
    }
}
