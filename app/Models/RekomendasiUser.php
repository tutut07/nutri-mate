<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiUser extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi_user';

    // ✅ AKTIFKAN TIMESTAMPS (WAJIB)
    public $timestamps = true;

    protected $fillable = [
    'user_id',
    'nama',
    'kategori',
    'usia',
    'berat',
    'tinggi',
    'jenis_kelamin',
    'data_bahan_id',
    'tanggal'
];



    // ✅ CAST KE CARBON (BIAR JAM AMAN)
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tanggal'    => 'date',
    ];

    // ✅ RELASI KE DATA BAHAN
    public function bahan()
    {
        return $this->belongsTo(DataBahan::class, 'data_bahan_id');
    }
}
