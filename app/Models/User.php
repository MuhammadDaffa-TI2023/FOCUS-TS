<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }
    public function mentor()
    {
        return $this->hasOne(Mentor::class, 'user_id');
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'user_id');
    }
    public function dokumen()
    {
        return $this->hasOne(Dokumen::class, 'user_id');
    }
    public function janjitemu()
    {
        return $this->hasOne(JanjiTemu::class, 'user_id');
    }
    public function materi()
    {
        return $this->hasOne(Materi::class, 'user_id');
    }
}
