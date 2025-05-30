<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayahModel extends Model
{
    protected $table = 'wilayah';
    protected $fillable = [
        'nama_wilayah',
    ];

    public function voter(){
        return $this->hasMany(VoteModel::class, 'wilayah_id', 'id');
    }
}
