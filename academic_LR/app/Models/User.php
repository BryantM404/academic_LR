<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'username', 'password', 'role_id'];

    protected $keyType = 'string';

    public $incrementing = false;

    public function roleUser() {
        return this->belongsTo(Role::class, 'role_id');
    }

    
}
