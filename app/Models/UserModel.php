<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authentication;

class UserModel extends Authentication
{
    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
        'created_at',
        'update_at'
    ];

    protected $hidden =[
        'password',
    ];

    protected $cats =[
        'password' => 'hashed',
    ];
    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function getRoleName(){
        return $this->level->level_nama;
    }

    public function hasRole($role)
    {
        return ($this->level->level_kode === $role);
    }

    public function getRole(){
        return $this->level->level_kode;
    }
}
