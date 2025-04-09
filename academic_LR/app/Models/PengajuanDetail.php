<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDetail extends Model
{
    protected $table = 'pengajuanDetail';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'semester', 'tujuan', 'kodeMK', 'namaMK', 'pengajuan_id'];
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    public function pengajuanDetailPengajuan(){
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

}
