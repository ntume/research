<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    //

    protected $fillable = [
      'fullname','email','contact','location','qualification',
    ];

    public function getStudents(){
      return $this->hasManyThrough('App\Student','App\StudentExaminer');
    }
}
