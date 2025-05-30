<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteHistoryModel extends Model
{
    protected $fillable = [
        'history_id',
        'vote_id',
        'candidate_id',
        'vote_time',
        'status',
        
    ];
}
