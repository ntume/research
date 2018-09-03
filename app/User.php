<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\LockableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LockableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
      return $this->belongsTo('App\Role');
    }

    public function isAdmin(){
      if($this->role->role == 'Admin'){
        return true;
      }
      return false;
    }

    public function isSupervisor(){
      if($this->role->role == 'Supervisor'){
        return true;
      }
      return false;
    }

    public function isStudent(){
      if($this->role->role == 'Student'){
        return true;
      }
      return false;
    }

}
