<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;
    protected $table = 'ruang';
    protected $fillable = [
        //'id_ruang',
        'nama_ruang',
        'fasilitas',
        'lokasi',
    ];

    // Definisikan relasi Ruang dengan PeminjamanUser
    public function peminjamanusers()
    {
        return $this->hasMany(PeminjamanUser::class, 'id_ruang');
    }
}
