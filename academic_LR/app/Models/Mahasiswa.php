<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nrp', 'nama', 'email', 'alamat', 'noTelp', 'tanggalLahir', 'prodi_id', 'user_id'];
    protected $keyType = "string";
    public $incrementing = false;

    public function mahasiswaProdi(){
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function mahasiswaPengajuan(){
        return $this->hasMany(Pengajuan::class);
    }

    public function mahasiswaUser(){
        return $this->hasOne(User::class, 'user_id');
    }
}
