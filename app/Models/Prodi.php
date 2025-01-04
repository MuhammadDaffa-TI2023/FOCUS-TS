<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = "prodis";

    protected $fillable = ["nama"];

    public function mahasiswa() {
        return $this->hasMany(Mahasiswa::class,'prodi_id');
    }
}
