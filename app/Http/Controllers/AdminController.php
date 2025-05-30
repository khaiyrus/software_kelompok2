<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WilayahModel;

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
    public function wilayah()
    {
        return view('admin.wilayah');
    }
    public function wilayah_add()
    {
        return view('admin.wilayah_add');
    }
    public function wilayah_add_proses(Request $request)
    {

        $request->validate([
            'nama_wilayah' => 'required|string',
        ]);

        // dd($request->all());
        WilayahModel::create([
            'nama_wilayah' => $request->nama_wilayah,

        ]);

        // Redirect atau tampilkan notifikasi
        return redirect()->route('wilayah_add')->with('success');
    }



}
