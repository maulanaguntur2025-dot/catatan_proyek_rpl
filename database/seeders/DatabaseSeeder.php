<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Student A
        $budi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@siswa.id',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $budi->proyek()->createMany([
            [
                'nama_proyek' => 'Sistem Peminjaman Buku Perpustakaan',
                'jenis_proyek' => 'Web',
                'teknologi' => 'Laravel, MySQL, Bootstrap',
                'deskripsi' => 'Aplikasi berbasis web untuk memudahkan pencatatan peminjaman dan pengembalian buku di perpustakaan sekolah.',
                'status_proyek' => 'Selesai',
                'tanggal_mulai' => '2026-01-10',
                'tanggal_selesai' => '2026-02-15',
            ],
            [
                'nama_proyek' => 'Aplikasi Pengingat Jadwal Belajar',
                'jenis_proyek' => 'Mobile',
                'teknologi' => 'Flutter, Firebase',
                'deskripsi' => 'Aplikasi mobile untuk membantu siswa mengelola waktu belajar mandiri dengan notifikasi alarm pengingat.',
                'status_proyek' => 'Proses',
                'tanggal_mulai' => '2026-03-01',
                'tanggal_selesai' => '2026-06-30',
            ],
            [
                'nama_proyek' => 'Desain Portofolio Pribadi',
                'jenis_proyek' => 'UI Design',
                'teknologi' => 'Figma',
                'deskripsi' => 'Perancangan antarmuka pengguna (UI/UX) untuk website portofolio pribadi bertema minimalis modern.',
                'status_proyek' => 'Perencanaan',
                'tanggal_mulai' => '2026-05-15',
                'tanggal_selesai' => '2026-05-25',
            ]
        ]);

        // Student B
        $siti = User::create([
            'name' => 'Siti Rahma',
            'email' => 'siti@siswa.id',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $siti->proyek()->createMany([
            [
                'nama_proyek' => 'Sistem Kasir Kantin Sekolah',
                'jenis_proyek' => 'Web',
                'teknologi' => 'PHP Native, MySQL, Tailwind CSS',
                'deskripsi' => 'Aplikasi kasir sederhana berbasis web untuk mempermudah transaksi pembayaran makanan di kantin.',
                'status_proyek' => 'Selesai',
                'tanggal_mulai' => '2026-02-01',
                'tanggal_selesai' => '2026-02-28',
            ],
            [
                'nama_proyek' => 'Game Edukasi Sejarah Indonesia',
                'jenis_proyek' => 'Mobile',
                'teknologi' => 'Unity 2D, C#',
                'deskripsi' => 'Game edukasi bergenre kuis petualangan untuk siswa SMP dalam mempelajari sejarah kemerdekaan Indonesia.',
                'status_proyek' => 'Revisi',
                'tanggal_mulai' => '2026-04-01',
                'tanggal_selesai' => '2026-05-10',
            ]
        ]);
    }
}
