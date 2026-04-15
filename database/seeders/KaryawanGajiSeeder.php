<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanGajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = [
            ['nama' => 'Budi Santoso', 'posisi' => 'Software Engineer'],
            ['nama' => 'Siti Aminah', 'posisi' => 'Project Manager'],
            ['nama' => 'Agus Setiawan', 'posisi' => 'UI/UX Designer'],
            ['nama' => 'Dewi Lestari', 'posisi' => 'Quality Assurance'],
            ['nama' => 'Rian Hidayat', 'posisi' => 'Data Scientist'],
        ];

        foreach ($karyawans as $data) {
            $karyawan = \App\Models\Karyawan::create($data);
            
            \App\Models\Gaji::create([
                'karyawan_id' => $karyawan->id,
                'jumlah_gaji' => rand(5000000, 15000000),
                'bulan_tahun' => 'April 2026'
            ]);
        }
    }
}
