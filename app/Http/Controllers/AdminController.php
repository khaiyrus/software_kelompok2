<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\VoteModel;
use App\Models\VotingModel;
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
        $user=User::all();
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
    ////////////////////////candidat profile/////////////////////////////////////////////////////////////////////////////////
    public function kandidat()
    {
        return view('admin.data_kandidat');
    }


    // wilayah/////////////////////////////////////////////////////////////////////////////////////////
    public function wilayah()
    {
        $wilayah=WilayahModel::all();
        return view('admin.wilayah.wilayah', compact('wilayah'));
    }

    public function wilayah_edit ($id) {
        $wilayah = WilayahModel::where('id', $id)->first();
        return view('admin.wilayah.wilayah_edit', compact('wilayah'));
    }
    public function wilayah_edit_proses (Request $request, $id) {

        $request->validate([
            'nama_wilayah' => 'required|string',
        ]);

        $wilayah = WilayahModel::where('id',$id)->first();

        $wilayah->nama_wilayah = $request->nama_wilayah;
        $wilayah->save();

        return redirect()->route('admin.wilayah');
    }
    public function wilayah_add()
    {
        return view('admin.wilayah.wilayah_add');
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
        return redirect()->route('admin.wilayah')->with('success');
    }

    public function wilayah_hapus ($id){
        $wilayah = WilayahModel::where('id', $id)->first();
        $wilayah->delete();

        return redirect()->route('admin.wilayah');
    }

///////////////voter/////////////////////////////////////////////////////////////////////////////////////////////////////
    public function voter()
    {   $vote=VoteModel::all();
        return view('admin.voter.data_voter', compact('vote'));
    }
    public function voter_add()
    {
        $wilayah=WilayahModel::all();
        return view('admin.voter.add_voter', compact('wilayah'));
    }
    public function voter_add_proses(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        VoteModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'wilayah_id' => $request->wilayah_id,
            'status' => false

        ]);

        // Redirect atau tampilkan notifikasi
        return redirect()->route('admin.voter')->with('success');
    }
    public function voter_edit ($id) {
        $wilayah=WilayahModel::all();
        $vote = VoteModel::where('id', $id)->first();
        return view('admin.voter.voter_edit', compact('vote', 'wilayah'));
    }
    public function voter_edit_proses (Request $request, $id) {

        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        $vote = VoteModel::where('id',$id)->first();

        $vote->nik = $request->nik;
        $vote->nama = $request->nama;
        $vote->wilayah_id = $request->wilayah_id;
        $vote->save();

        return redirect()->route('admin.voter');
    }
    ///////////////////////////////voting////////////////////////////////////////

    public function voting(){
        $voting=VotingModel::all();
        return view('admin.acara.voting', compact('voting'));
    }
    public function voting_add(){

        $wilayah=WilayahModel::all();
        return view('admin.acara.add_voting', compact('wilayah'));
    }
    public function voting_add_proses(Request $request)
    {

        $request->validate([
        'acara'      => 'required|string|max:255',
        'wilayah_id' => 'required|exists:wilayah,id',
    ]);

    VotingModel::create([
        'acara'      => $request->acara,
        'status'     => false,
        'wilayah_id' => $request->wilayah_id,
    ]);

    return redirect()->route('admin.voting')->with('success', 'Voting berhasil dibuat.');
}
public function voting_edit ($id) {
        $wilayah=WilayahModel::all();
        $voting = VotingModel::where('id', $id)->first();
        return view('admin.acara.edit_voting', compact('voting', 'wilayah'));
    }


    public function voting_edit_proses (Request $request, $id) {

        $request->validate([
        'acara'      => 'required|string|max:255',
        'wilayah_id' => 'required|exists:wilayah,id',]);

        $voting = VotingModel::where('id',$id)->first();

        $voting->acara = $request->acara;
        $voting->status = $request->status;
        $voting->wilayah_id = $request->wilayah_id;
        $voting->save();

        return redirect()->route('admin.voting');
}
public function voting_hapus ($id){
        $voting = VotingModel::where('id', $id)->first();
        $voting->delete();

        return redirect()->route('admin.voting');
    }
}
