<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class mahasiswa extends Model
{
    //
    use HasFactory;
    
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'nim',
        'foto',
        'jenis_kelamin',
        'prodi',
        'angkatan',
    ];
    public function user()
    {
        
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(matakuliah::class, 'kontrak_mk', 'nim', 'kode_mk');
    }
    public function jawabanTugas()
    {
        return $this->hasMany(jawabanTugas::class, 'nim', 'nim');
    }

    public function absens()
    {
        return $this->hasMany(absens::class, 'nim', 'nim');
    }

}
