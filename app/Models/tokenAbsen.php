<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tokenAbsen extends Model
{
    protected $table = 'token_absen';

    protected $fillable = [
        'kode_mk',
        'jadwal',
        'token',
        'valid_from',
        'valid_until',
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('nama', 'LIKE', "%{$value}%")->orWhere('kode_mk', 'LIKE', "%{$value}%");
    }

    public function absens()
    {
        return $this->hasMany(absens::class, 'token_absen_id');
    }
}
