<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = "fakultas";

    protected $fillable = ["nama"];

    public function dosen() {
        return $this->hasMany(Dosen::class,'fakultas_id');
    }
}
