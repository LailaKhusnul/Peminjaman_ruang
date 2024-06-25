<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanUser extends Model
{
    use HasFactory;
    protected $table = 'peminjamanuser';
    protected $fillable = [
        'user_id',
        'id_ruang',
        'tanggal_mulai',
        'tanggal_selesai',
        'kegiatan',
        'status',
    ];

    // Definisi relasi ke model Ruang
    public function Ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang',);
    }

    // Definisi relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Asumsikan ada kolom 'user_id' yang merujuk ke tabel 'users'
    }
}
