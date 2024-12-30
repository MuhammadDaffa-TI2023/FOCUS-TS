<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";
    protected $fillable = ["nama", "nip", "fakultas_id"];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function janjitemu()
    {
        return $this->hasMany(JanjiTemu::class, 'mahasiswa_id');
    }
}
