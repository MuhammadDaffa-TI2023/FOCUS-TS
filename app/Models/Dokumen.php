<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = "dokumen";
    protected  $fillable = ["keterangan", "keterangan_dosen","user_id", "file", "status", "dosen_id"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
