<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';

    protected $fillable = [
        'user_id',
        'nama_proyek',
        'jenis_proyek',
        'teknologi',
        'deskripsi',
        'status_proyek',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
