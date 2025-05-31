<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteHistoryModel extends Model
{
    protected $table = 'vote_history';
    protected $fillable = [
        'vote_id',
        'status',
        'voting_model_id',
        'candidate_id',
    ];

    public function acara () {
        return $this->belongsTo(VotingModel::class, 'voting_model_id', 'id');
    }

    public function kandidat () {
        return $this->belongsTo(User::class, 'candidate_id', 'id');
    }

    public function pemilih(){
        return $this->belongsTo(VoteModel::class, 'vote_id','id');
    }
}
