<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfile;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\VoteModel;
use App\Models\VotingModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WilayahModel;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function user()
    {
        $user = User::all();
        return view('admin.user.user', compact('user'));
    }
    public function user_add()
    {
        return view('admin.user.add_user');
    }
    public function user_add_proses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,panitia,kandidat',
        ]);

        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect atau tampilkan notifikasi
        return redirect()->route('admin.user')->with('success');
    }
    ////////////////////////candidat profile///////////////////////////////////////////////////////////////////
    public function kandidat()
    {
        $kandidat = CandidateProfile::all();
        return view('admin.kandidat.data_kandidat', compact('kandidat'));
    }
    public function profile_add()
    {
        $wilayah = WilayahModel::all();
        return view('admin.kandidat.add_candidat', compact('wilayah'));
    }

    public function jabatan()
    {
        $jabatan = Jabatan::all();
        return view('admin.jabatan.data_jabatan', compact('jabatan'));
    }

    public function jabatan_add()
    {
        return view('admin.jabatan.jabatan_add');
    }
    public function jabatan_add_proses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'level' => 'required|in:kota,kabupaten,provinsi',
        ]);

        // dd($request->all());
        jabatan::create([
            'nama' => $request->nama,
            'level' => $request->level,
        ]);

        // Redirect atau tampilkan notifikasi
        return redirect()->route('admin.jabatan')->with('success');
    }

    public function jabatan_hapus($id)
    {
        $jabatan = Jabatan::where('id', $id)->first();
        $jabatan->delete();

        return redirect()->route('admin.jabatan');
    }
    public function jabatan_edit($id)
    {
        $jabatan = Jabatan::where('id', $id)->first();
        return view('admin.jabatan.jabatan_edit', compact('jabatan'));
    }
    public function jabatan_edit_proses(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'level' => 'required|string',
        ]);

        $jabatan = Jabatan::where('id', $id)->first();

        $jabatan->nama = $request->nama;
        $jabatan->level = $request->level;
        $jabatan->save();

        return redirect()->route('admin.jabatan');
    }

    // wilayah/////////////////////////////////////////////////////////////////////////////////////////
    public function wilayah()
    {
        $wilayah = WilayahModel::all();
        return view('admin.wilayah.wilayah', compact('wilayah'));
    }

    public function wilayah_edit($id)
    {
        $wilayah = WilayahModel::where('id', $id)->first();
        return view('admin.wilayah.wilayah_edit', compact('wilayah'));
    }
    public function wilayah_edit_proses(Request $request, $id)
    {
        $request->validate([
            'nama_wilayah' => 'required|string',
        ]);

        $wilayah = WilayahModel::where('id', $id)->first();

        $wilayah->nama_wilayah = $request->nama_wilayah;
        $wilayah->save();

        return redirect()->route('admin.wilayah');
    }
    public function wilayah_add()
    {
        $parentWilayah = WilayahModel::all();
        return view('admin.wilayah.wilayah_add', compact('parentWilayah'));
    }
    public function wilayah_add_proses(Request $request)
    {
        $request->validate([
            'nama_wilayah' => 'required|string',
            'level' => 'required|in:kota,kabupaten,provinsi',
            'parent_id' => 'nullable|exists:wilayah,id',
        ]);

        WilayahModel::create([
            'nama_wilayah' => $request->nama_wilayah,
            'level' => $request->level,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.wilayah')->with('success', 'Wilayah berhasil ditambahkan!');
    }
    public function wilayah_hapus($id)
    {
        $wilayah = WilayahModel::where('id', $id)->first();
        $wilayah->delete();

        return redirect()->route('admin.wilayah');
    }

    ///////////////voter/////////////////////////////////////////////////////////////////////////////////////////////////////
    public function voter()
    {
        $vote = VoteModel::all();
        return view('admin.voter.data_voter', compact('vote'));
    }
    public function voter_add()
    {
        $wilayah = WilayahModel::where('level', 'kota')->get();
        $acara = VotingModel::all();
        return view('admin.voter.add_voter', compact('wilayah', 'acara'));
    }
    public function voter_add_proses(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'wilayah_id' => 'required|exists:wilayah,id',
            'voting_model_id' => 'required|exists:voting_models,id',
        ]);

        VoteModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'wilayah_id' => $request->wilayah_id,
            'voting_model_id' => $request->voting_model_id,
            'status' => false,
        ]);

        // Redirect atau tampilkan notifikasi
        return redirect()->route('admin.voter')->with('success');
    }
    public function voter_edit($id)
    {
        $wilayah = WilayahModel::all();
        $vote = VoteModel::where('id', $id)->first();
        return view('admin.voter.voter_edit', compact('vote', 'wilayah'));
    }
    public function voter_edit_proses(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        $vote = VoteModel::where('id', $id)->first();

        $vote->nik = $request->nik;
        $vote->nama = $request->nama;
        $vote->wilayah_id = $request->wilayah_id;
        $vote->save();

        return redirect()->route('admin.voter');
    }
    public function voter_hapus($id)
    {
        $vote = VoteModel::where('id', $id)->first();
        $vote->delete();

        return redirect()->route('admin.voter');
    }

    ///////////////////////////////voting////////////////////////////////////////

    public function voting()
    {
        $voting = VotingModel::all();
        return view('admin.acara.voting', compact('voting'));
    }
    public function voting_add()
    {
        $wilayah = WilayahModel::all();
        return view('admin.acara.add_voting', compact('wilayah'));
    }
    public function voting_add_proses(Request $request)
    {
        $validated = $request->validate([
            'acara' => 'required|string|max:255',
            'voting_sampai' => 'required|date_format:H:i',
            'wilayah_id' => 'required|exists:wilayah,id',
            'user_id' => 'required|exists:users,id',
        ]);

        VotingModel::create([
            'acara' => $validated['acara'],
            'voting_sampai' => $validated['voting_sampai'],
            'wilayah_id' => $validated['wilayah_id'],
            'status' => false, // default status false
            'user_id' => $validated['user_id'],
        ]);
        return redirect()->route('admin.voting')->with('success', 'Voting berhasil dibuat.');
    }
    public function voting_edit($id)
    {
        $wilayah = WilayahModel::all();
        $voting = VotingModel::where('id', $id)->first();
        return view('admin.acara.edit_voting', compact('voting', 'wilayah'));
    }

    public function voting_edit_proses(Request $request, $id)
    {
        $request->validate([
            'acara' => 'required|string|max:255',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        $voting = VotingModel::where('id', $id)->first();

        $voting->acara = $request->acara;
        $voting->status = $request->status;
        $voting->wilayah_id = $request->wilayah_id;
        $voting->save();

        return redirect()->route('admin.voting');
    }
    public function voting_hapus($id)
    {
        $voting = VotingModel::where('id', $id)->first();
        $voting->delete();

        return redirect()->route('admin.voting');
    }
    ///////////////////////////GALERY ///////////////////////////
    public function galery()
    {
        $galery = CandidateProfile::all();
        return view('admin.kandidat.data_galery', compact('galery'));
    }
}
