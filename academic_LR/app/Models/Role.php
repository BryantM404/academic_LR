<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama'];
    protected $keyType = 'int'; 
    public $incrementing = true;
    public $timestamps = false;

    public function roleUser(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
