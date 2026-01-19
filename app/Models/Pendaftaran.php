<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'paket_id',
        'pendidikan',
        'sekolah_univ',
        'jurusan_program',
        'kelas_tingkat',
        'nim_nisn',
        'phone',
        'cv_link',
        'status',
        'keterangan',
        'tanggal_daftar'
    ];

    // Tambahkan ini:
    protected $casts = [
        'tanggal_daftar' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
{
    return $this->belongsTo(Pricelist::class, 'paket_id');
}

}
