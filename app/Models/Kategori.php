<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "kategori";

    protected $fillable = ["nama"];

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kategori_id');
    }
}
