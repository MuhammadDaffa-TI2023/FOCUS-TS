<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model
{
    protected $table = "janji_temu";

    protected $fillable = ["tanggal", "jam", "status", "mahasiswa_id", "dosen_id", "user_id"];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id');
    }
    public function dosen() {
        return $this->belongsTo(Dosen::class,'dosen_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
