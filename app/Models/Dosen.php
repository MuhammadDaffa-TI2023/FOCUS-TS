<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";
    protected $fillable = ["nama", "nip", "fakultas_id", "user_id", "email"];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function janjitemu()
    {
        return $this->hasMany(JanjiTemu::class, 'mahasiswa_id');
    }
    public function Dokumen()
    {
        return $this->hasMany(Dokumen::class, 'dosen_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
