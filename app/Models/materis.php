<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class materis extends Model
{
    //
    protected $table = 'materi';
    protected $primaryKey = 'kode_materi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode_materi', 
        'nama', 
        'kode_mk', 
        'deskripsi', 
        'file_materi'
    ];
    public function scopeSearch($query, $value){
        $query->where('nama', 'LIKE', "%{$value}%")->orWhere('kode_materi', 'LIKE', "%{$value}%");
    }
    public function matakuliah()
    {
        return $this->belongsTo(matakuliah::class, 'kode_mk', 'kode_mk');
    }
}
