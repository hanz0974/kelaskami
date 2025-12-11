<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\tugass;

class jawabanTugas extends Model
{
    protected $table = 'jawaban_tugas';
    protected $fillable = [
        'kode_tugas',
        'nim',
        'deskripsi',
        'jawaban_tugas',
        'status',
        'nilai',
    ];
    public function scopeSearch($query, $value)
    {
        $query->where('nim', 'LIKE', "%{$value}%")->orWhere('kode_tugas', 'LIKE', "%{$value}%");
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function tugas()
    {
        return $this->belongsTo(tugass::class, 'kode_tugas', 'kode_tugas');
    }

}
