<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteModel extends Model
{
    protected $table = 'voter';
    protected $fillable = [
        'nik',
        'nama',
        'status',
        'wilayah_id',
        'voting_model_id',
    ];

    public function wilayah() {
        return $this->belongsTo(WilayahModel::class, 'wilayah_id', 'id');
    }

    public function acara () {
        return $this->belongsTo(VotingModel::class, 'voting_model_id', 'id');
    }

    public function history () {
        return $this->hasOne(VoteHistoryModel::class, 'vote_id', 'id');
    }
}

