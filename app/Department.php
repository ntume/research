<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'department',
    ];

    public function courses(){
      return $this->hasMany('App\Course');
    }

    public function students(){
      return $this->hasMany('App\Student');
    }

    public function subjects(){
      return $this->hasManyThrough('App\Subject','App\Course');
    }

}
