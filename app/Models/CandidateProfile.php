<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    protected $fillable = [
        'wilayah_id',
        'user_id',
        'visi',
        'misi',
        'photo',
    ];

    public function kandidat() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wilayah () {
        return $this->belongsTo(WilayahModel::class, 'wilayah_id', 'id');
    }
}
