<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TataUsaha extends Model
{
    protected $table = 'tataUsaha';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama', 'prodi_id', 'user_id'];
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function tataUsahaUser() {
        return $this->hasOne(User::class, 'user_id');
    }

    public function tataUsahaProdi(){
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
