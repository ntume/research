<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
      'department_id','course',
    ];

    public function department(){
      return $this->belongsTo('App\Department');
    }

    public function subjects(){
      return $this->hasMany('App\Subject');
    }

    public function students(){
      return $this->hasManyThrough('App\Student_Subject','App\Subject');
    }
}
