<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayahModel extends Model
{
    protected $table = 'wilayah';
    protected $fillable = [
        'nama_wilayah',
        'level', 'parent_id'    ];

    public function voter(){
        return $this->hasMany(VoteModel::class, 'wilayah_id', 'id');
    }
    public function profil(){
        return $this->hasMany(CandidateProfile::class, 'wilayah_id', 'id');
    }
    public function acara(){
        return $this->hasMany(VotingModel::class, 'wilayah_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(WilayahModel::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(WilayahModel::class, 'parent_id');
    }
}
