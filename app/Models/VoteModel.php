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
    ];

    public function wilayah() {
        return $this->belongsTo(WilayahModel::class, 'wilayah_id', 'id');
    }
}

