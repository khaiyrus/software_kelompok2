<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VotingModel extends Model
{
    protected $fillable =[
        'acara',
        'status',
        'user_id',
        'wilayah_id'
    ];
}
