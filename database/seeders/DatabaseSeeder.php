<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'admin daffa',
            'email' => 'admindaffa@gmail.com',
        ]);
        $user1->assignRole('admin');
        $user2 = User::factory()->create([
            'name' => 'mahasiswa daffa',
            'email' => 'mahasiswadaffa@gmail.com',
        ]);
        $user2->assignRole('mahasiswa');
        $user3 = User::factory()->create([
            'name' => 'dosen daffa',
            'email' => 'dosendaffa@gmail.com',
        ]);
        $user3->assignRole('dosen');
        $user4 = User::factory()->create([
            'name' => 'mentor daffa',
            'email' => 'mentordaffa@gmail.com',
        ]);
        $user4->assignRole('mentor');
    }
}
