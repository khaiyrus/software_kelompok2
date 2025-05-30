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
    ];
}
