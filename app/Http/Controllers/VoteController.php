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
        $wilayah = WilayahModel::where('level', 'kota')->get();
        return view('voting.cek', compact('wilayah'));
    }

    public function cek(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required',
            'wilayah' => 'required|string|exists:wilayah,id',
        ]);

        $voter = VoteModel::where([
            ['nik', $request->nik],
            ['nama', $request->nama],
            ['wilayah_id', $request->wilayah],
        ])->first();

        if (!$voter) {
            return back()->with(['info' => 'Data pemilih tidak ditemukan.']);
        }

        session([
            'voter_id' => $voter->id,
            'voter_voting_model_id' => $voter->voting_model_id,
        ]);

        return redirect()->route('voting.formVote');
    }

    public function formVote()
    {
        $voter = VoteModel::findOrFail(session('voter_id'));
        $acara = $voter->acara;

        // cek deadline
        if (now() > $acara->voting_sampai) {
            return redirect()->route('voting.result')->with('info', 'Waktu voting telah habis.');
        }

        $kandidat = CandidateProfile::where('voting_model_id', $acara->id)->get();

        return view('voting.vote', compact('voter', 'acara', 'kandidat'));
    }

    public function voteSubmit(Request $request)
    {
        $voter = VoteModel::findOrFail(session('voter_id'));

        if ($voter->status) {
            return redirect()->route('voting.result')->with(['info' => 'Anda sudah memilih.']);
        }

        VoteHistoryModel::create([
            'vote_id' => $voter->id,
            'voting_model_id' => $voter->voting_model_id,
            'candidate_id' => $request->terpilih,
        ]);

        $voter->update(['status' => true]);

        // Cek apakah semua voter sudah selesai voting
        $jumlahVoter = VoteModel::where('voting_model_id', $voter->voting_model_id)->where('status', true)->count();
        $totalVoter = VoteModel::where('voting_model_id', $voter->voting_model_id)->count();

        if ($jumlahVoter == $totalVoter) {
            $voter->acara->update(['status' => true]);
        }

        return redirect()->route('voting.result');
    }

    public function result()
    {
        $votingId = session('voter_voting_model_id');
        $pemenang = VoteHistoryModel::select('candidate_id', DB::raw('COUNT(*) as total'))
            ->where('voting_model_id', $votingId)
            ->groupBy('candidate_id')
            ->orderByDesc('total')
            ->first();

        $winner = User::find($pemenang->candidate_id ?? 0);
        $acara = VotingModel::find($votingId);
        $jumlahVoter = VoteModel::where('voting_model_id', $votingId)->where('status', true)->count();

        return view('voting.result', compact('winner', 'acara', 'jumlahVoter'));
    }

    public function keluar()
    {
        session()->forget(['voter_id', 'voter_voting_model_id']);
        return redirect()->route('voting.cek')->with('info', 'Anda telah keluar.');
    }
}
