<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";

    protected $fillable = ["nama", "nim", "prodi_id"];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function janjitemu()
    {
        return $this->hasMany(JanjiTemu::class, 'mahasiswa_id');
    }
}
