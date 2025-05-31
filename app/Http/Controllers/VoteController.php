<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfile;
use App\Models\User;
use App\Models\VoteHistoryModel;
use App\Models\VoteModel;
use App\Models\VotingModel;
use App\Models\WilayahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VoteController extends Controller
{
    public function formCek()
    {
        $wilayah = WilayahModel::all();
        return view('voting.cek', compact('wilayah'));
    }

    public function cek(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required',
            'wilayah' => 'required|string|exists:wilayah,id',
        ]);

        // dd($request->all());

        $wilayah = WilayahModel::where('id', $request->wilayah)->first();

        if (!$wilayah) {
            return back()->with(['info' => 'Wilayah tidak ditemukan.']);
        }

        $voter = VoteModel::where('nik', $request->nik)->where('nama', $request->nama)->where('wilayah_id', $wilayah->id)->first();

        if (!$voter) {
            return back()->with(['info' => 'Data pemilih tidak ditemukan.']);
        }

        session([
            'voter_id' => $voter->id,
            'voter_nama' => $voter->nama,
            'voter_nik' => $voter->nik,
            'voter_wilayah' => $voter->wilayah_id,
            'voter_voting_model_id' => $voter->acara->id,
            'voter_wilayah_nama' => $voter->wilayah->nama_wilayah,
        ]);

        return redirect()->route('voting.formVote');
    }
    public function formVote()
    {
        $voter = VoteModel::where('id', session('voter_id'))->first();
        return view('voting.vote', compact('voter'));
    }

    public function voteSubmit(Request $request)
    {
        $voter = VoteModel::where('id', session('voter_id'))->first();
        if ($voter->status) {
            return redirect()
                ->route('voting.result')
                ->with(['info' => 'Anda sudah menggunakan hak pilih.']);
        }
        VoteHistoryModel::create([
            'vote_id' => $voter->id,
            'voting_model_id' => $voter->acara->id,
            'candidate_id' => $request->terpilih,
        ]);

        $voter->status = true;
        $voter->save();

        // cek apakah semua voter dengan id voting yang sama sudah memilih semua atau tidak
        $jumlahVoter = VoteModel::where('voting_model_id', session('voter_voting_model_id'))->where('status', true)->count();
        $acara = VotingModel::where('id', session('voter_voting_model_id'))->first();

        if ($acara->voter->count() == $jumlahVoter) {
            $acara->status = true;
            $acara->save();
        }
        return redirect()->route('voting.result');
    }

    public function result()
    {
        $pemenang = $pemenang = DB::table('vote_history')
            ->select('candidate_id', DB::raw('COUNT(*) as total_votes'))
            ->where('voting_model_id', session('voter_voting_model_id')) // Ganti dengan ID voting yang ingin dicek
            ->groupBy('candidate_id')
            ->orderByDesc('total_votes')
            ->first();

        $pemenang = User::find($pemenang->candidate_id);
        $acara = VotingModel::where('id', session('voter_voting_model_id'))->first();
        $jumlahVoter = VoteModel::where('voting_model_id', session('voter_voting_model_id'))->where('status', true)->count();
        $voter = VoteModel::where('id', session('voter_id'))->first();
        return view('voting.result', compact('voter', 'acara', 'jumlahVoter' ,'pemenang'));
    }

    public function keluar()
    {
        session()->forget(['voter_id', 'voter_nama', 'voter_nik', 'voter_wilayah', 'voter_wilayah_nama']);

        return redirect()->route('voting.cek')->with('info', 'Anda telah keluar dari sesi voting.');
    }
}
