<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class dosen extends Model
{
    //
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama',
        'nip',
        'foto',
    ];
    public function tugas()
    {
        return $this->hasMany(tugass::class, 'nip', 'nip');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
