<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';

    protected $primaryKey = 'kode_mk';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk',
        'nama',
        'foto',
        'kelas',
        'sks',
        'semester',
    ];

    public function mahasiswa()
    {
        return $this->belongsToMany(mahasiswa::class, 'kontrak_mk', 'kode_mk', 'nim');
    }

    public function tokenAbsens()
    {
        return $this->hasMany(tokenAbsen::class, 'kode_mk', 'kode_mk');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'LIKE', "%{$value}%")->orWhere('kode_mk', 'LIKE', "%{$value}%");
    }

    public function absens()
    {
        return $this->hasManyThrough(
            absens::class,
            tokenAbsen::class,
            'kode_mk',        // FK di token_absen
            'token_absen_id', // FK di absen
            'kode_mk',        // PK di matakuliah
            'id'              // PK di token_absen
        );
    }
}
