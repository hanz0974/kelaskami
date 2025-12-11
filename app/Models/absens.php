<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absens extends Model
{
    //
    protected $table = 'absens';

    protected $fillable = [
        'nim',
        'kode_mk',
        'token_absen_id',
        'tanggal',
        'status',
        'jadwal',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(mahasiswa::class, 'nim', 'nim');
    }

    public function matakuliah()
    {
        return $this->hasOneThrough(
            matakuliah::class,
            tokenAbsen::class,
            'id',             // PK di token_absen
            'kode_mk',        // PK di matakuliah
            'token_absen_id', // FK di absen
            'kode_mk'         // FK di token_absen
        );
    }

    public function scopeSearchMahasiswa($query, $value)
    {
        return $query->whereHas('mahasiswa', function ($q) use ($value) {
            $q->where('nama', 'like', "%{$value}%")
                ->orWhere('nim', 'like', "%{$value}%");
        });
    }

    public function tokenAbsen()
    {
        return $this->belongsTo(tokenAbsen::class, 'token_absen_id');
    }
}
