<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = "materi";

    protected $fillable = ["nama","kategori_id", "user_id", "file", "tanggal"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
