<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tugass extends Model
{
    protected $table = 'tugas';

    protected $primaryKey = 'kode_tugas';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'kode_tugas',
        'kode_mk',
        'title',
        'deskripsi',
        'deadline',
        'file_tugas',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('title', 'LIKE', "%{$value}%")->orWhere('kode_tugas', 'LIKE', "%{$value}%");
    }

    public function jawaban()
    {
        return $this->hasMany(jawabanTugas::class, 'kode_tugas');
    }

    public function matakuliah()
    {
        return $this->belongsTo(matakuliah::class, 'kode_mk', 'kode_mk');
    }

    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'nip','nip');
    }
}
