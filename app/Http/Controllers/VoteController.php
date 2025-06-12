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

        $wilayah = WilayahModel::find($request->wilayah);

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
            'voter_voting_model_id' => $voter->voting_model_id,
            'voter_wilayah_nama' => $wilayah->nama_wilayah,
        ]);

        return redirect()->route('voting.formVote');
    }

    public function formVote()
    {
        $voter = VoteModel::findOrFail(session('voter_id'));
        $acara = $voter->acara;

        // Cek apakah waktu voting habis
        if (now() > $acara->voting_sampai) {
            return redirect()->route('voting.result')->with('info', 'Waktu voting telah habis.');
        }

        // Ambil semua wilayah anak (kabupaten/kota) dari wilayah acara (provinsi)
        $wilayah_anak = WilayahModel::where('parent_id', $acara->wilayah_id)->pluck('id')->toArray();

        // Termasuk provinsi itu sendiri (jika kandidat level provinsi juga boleh muncul)
        $wilayah_ids = array_merge($wilayah_anak, [$acara->wilayah_id]);

        // Ambil kandidat di wilayah anak-anak itu
        $kandidat = CandidateProfile::whereIn('wilayah_id', $wilayah_ids)->get();

        return view('voting.vote', compact('voter', 'acara', 'kandidat'));
    }

    public function voteSubmit(Request $request)
    {
        $voter = VoteModel::findOrFail(session('voter_id'));
        $acara = $voter->acara;

        if ($voter->status) {
            return redirect()
                ->route('voting.result')
                ->with(['info' => 'Anda sudah memilih.']);
        }

        // Cek kandidat valid sesuai wilayah acara
        $wilayah_anak = WilayahModel::where('parent_id', $acara->wilayah_id)->pluck('id')->toArray();
        $wilayah_ids = array_merge($wilayah_anak, [$acara->wilayah_id]);

        $kandidat = CandidateProfile::whereIn('wilayah_id', $wilayah_ids)->where('id', $request->terpilih)->first();

        if (!$kandidat) {
            return redirect()
                ->back()
                ->with(['info' => 'Kandidat tidak valid.']);
        }

        // Simpan vote
        VoteHistoryModel::create([
            'vote_id' => $voter->id,
            'voting_model_id' => $voter->voting_model_id,
            'candidate_id' => $request->terpilih,
        ]);

        $voter->update(['status' => true]);

        $jumlahVoter = VoteModel::where('voting_model_id', $voter->voting_model_id)->where('status', true)->count();
        $totalVoter = VoteModel::where('voting_model_id', $voter->voting_model_id)->count();

        if ($jumlahVoter == $totalVoter) {
            $acara->update(['status' => true]);
        }

        return redirect()->route('voting.result');
    }

    public function result()
    {
        $votingId = session('voter_voting_model_id');

        $pemenang = VoteHistoryModel::select('candidate_id', DB::raw('COUNT(*) as total'))->where('voting_model_id', $votingId)->groupBy('candidate_id')->orderByDesc('total')->first();

        // Cari pemenang kandidat profile
        $winner = null;
        if ($pemenang) {
            $kandidat = CandidateProfile::with('kandidat')->find($pemenang->candidate_id);
            $winner = $kandidat;
        }

        $acara = VotingModel::find($votingId);
        $jumlahVoter = VoteModel::where('voting_model_id', $votingId)->where('status', true)->count();
        $voter = VoteModel::findOrFail(session('voter_id'));

        return view('voting.result', compact('winner', 'acara', 'jumlahVoter', 'voter'));
    }

    public function keluar()
    {
        session()->forget(['voter_id', 'voter_voting_model_id']);
        return redirect()->route('voting.cek')->with('info', 'Anda telah keluar.');
    }
}
