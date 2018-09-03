<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisors extends Model
{
    //
    protected $fillable = [
      'fullname','email','contact','locale','qualification',
    ];

    public function specializations(){
      return $this->belongsToMany('App\Specialization', 'supervisor__specializations');
    }

    public function getStudents(){
      return $this->hasManyThrough('App\Student','App\StudentSupervisor');
    }

}
