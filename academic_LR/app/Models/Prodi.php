<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama'];
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    public function prodiMahasiswa(){
        return $this->HasMany(Mahasiswa::class);
    }

    public function prodiKaprodi(){
        return $this->hasOne(Kaprodi::class);
    }

    public function prodiTataUsaha(){
        return $this->hasMany(TataUsaha::class);
    }
}
