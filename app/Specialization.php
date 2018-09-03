<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    //
    protected $fillable = ['specialization',];

    public function supervisors(){
      return $this->belongsToMany('App\Supervisor','supervisor__specializations');
    }
}
