<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengajuan extends Model
{
    protected $table = 'statusPengajuan';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama'];
    protected $keyType = "string";
    public $incrementing = false;

    public function statusPengajuanPengajuan(){
        return $this->hasMany(Pengajuan::class);
    }
    
}
