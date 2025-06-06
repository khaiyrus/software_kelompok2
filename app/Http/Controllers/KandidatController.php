<?php

namespace App\Http\Controllers;

use App\Models\WilayahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CandidateProfile;
use App\Models\User;

class KandidatController extends Controller
{
    public function index()
    {
        $roles = User::select('role')->distinct()->pluck('role');
        return view('kandidat.dashboard', compact('user'));
    }
    public function profile()
    {
        return view('kandidat.profile');
    }
    public function profile_add()
    {
        $wilayah = WilayahModel::all();
        return view('kandidat.add_profile', compact('wilayah'));
    }

    public function profile_add_proses(Request $request)
    {
        // Validasi form input
        $request->validate([
            'profilePicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visi' => 'required|string|min:10|max:255',
            'misi' => 'required|string|min:10|max:255',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        // dd($request->all());
        $user = auth()->user();

        // Ambil profil kandidat milik user
        $profile = CandidateProfile::where('user_id', $user->id)->first();

        // Jika belum punya, buat baru
        if (!$profile) {
            $profile = new CandidateProfile();
            $profile->user_id = $user->id;
        }

        // Proses upload foto jika ada
        if ($request->hasFile('profilePicture')) {
            // Hapus foto lama jika ada
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }

            // Simpan foto baru
            $path = $request->file('profilePicture')->store('candidate_photos', 'public');
            $profile->photo = $path;
        }

        // Simpan data lain
        $profile->visi = $request->visi;
        $profile->misi = $request->misi;
        $profile->wilayah_id = $request->wilayah_id;
        $profile->save();

        return redirect()->route('kandidat.profile')->with('success', 'Profil kandidat berhasil diperbarui.');
    }
}
