<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    protected $fillable = [
        'profil_id',
        'user_id',
        'visi',
        'misi',
        'photo',
    ];
}
