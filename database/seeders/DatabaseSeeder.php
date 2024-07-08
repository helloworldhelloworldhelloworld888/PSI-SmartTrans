<?php

namespace Database\Seeders;

use App\Models\Pengguna;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //import data dari file sql DataLLM.sql
        $path = database_path('sql/DataLLM.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);

        Pengguna::factory()->create([
            'nama_lengkap' => 'Aulia',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'nomor_telepon' => '081234567890',
            'jenis_akun' => 'admin',
        ]);
    }
}
