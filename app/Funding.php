<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    //
    protected $fillable = ['name','description','funder'];

    public function students(){
      return $this->hasMany('App\Student');
    }
}
