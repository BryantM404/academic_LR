<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'tanggalPengajuan', 'dokumen', 'keterangan', 'mahasiswa_nrp', 'statusPengajuan_id', 'jenisSurat_id'];
    protected $keyType = "string";
    public $incrementing = false;

    public function pengajuanMahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nrp');
    }

    public function pengajuanStatusPengajuan(){
        return $this->belongsTo(StatusPengajuan::class, 'statusPengajuan_id');
    }

    public function pengajuanJenisSurat(){
        return $this->belongsTo(JenisSurat::class, 'jenisSurat_id');
    }

    public function pengajuanPengajuanDetail(){
        return $this->hasMany(PengajuanDetail::class);
    }


}
