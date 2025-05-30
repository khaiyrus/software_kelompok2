<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteModel extends Model
{
    protected $fillable = [
        'vote_id',
        'voter_id',
        'candidate_id',
        'vote_time',
    ];
}
