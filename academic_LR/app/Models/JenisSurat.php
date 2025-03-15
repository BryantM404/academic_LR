<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenisSurat';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama'];
    protected $keyType = "string";
    public $incrementing = false;

    public function jenisSuratPengajuan(){
        return $this->hasMany(Pengajuan::class);
    }
}
