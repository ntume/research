<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
      'course_id','subject_code','subject','year',
    ];

    public function course(){
      return $this->belongsTo('App\Course');
    }

    public function students(){
      return $this->belongsToMany('App\Student','student_subjects')
                  ->withPivot('registration_date', 'submit_date','submitted','average_grade','completed','funding_id')
                  ->withTimestamps();
    }
}
