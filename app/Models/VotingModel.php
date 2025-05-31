<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingModel extends Model
{
    protected $fillable =[
        'acara',
        'status',
        'voting_sampai',
        'wilayah_id'
    ];
    public function wilayah () {
        return $this->belongsTo(WilayahModel::class, 'wilayah_id', 'id');
    }

    public function history () {
        return $this->hasMany(VoteHistoryModel::class, 'voting_model_id', 'id');
    }

    public function voter () {
        return $this->hasMany(VoteModel::class, 'voting_model_id', 'id');
    }
}
