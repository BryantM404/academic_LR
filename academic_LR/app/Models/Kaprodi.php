<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    protected $table = 'kaprodi';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama', 'email', 'alamat', 'noTelp', 'tanggalLahir', 'prodi_id', 'user_id'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function kaprodiUser() {
        return $this->hasOne(User::class, 'user_id');
    }

    public function kaprodiProdi(){
        return $this->hasOne(Prodi::class, 'prodi_id');
    }
}
