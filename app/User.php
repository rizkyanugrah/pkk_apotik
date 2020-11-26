<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
// use Illuminate\Auth\Authenticatable;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Authenticatable
{
    // use Authenticatable;
    // use Authorizable;
    // use CanResetPassword;

    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'jenis_kelamin', 'gambar', 'no_telp', 'alamat', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
