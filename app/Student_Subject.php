<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Subject extends Model
{
    //
    protected $table = "student_subjects";

    protected $fillable = [
      'student_id','subject_id','registration_date','submit_date','submitted','average_grade','completed','funding_id'
    ];

    public function student(){
      return $this->belongsTo('App\Student','student_id');
    }

    public function subject(){
      return $this->belongsTo('App\Subject','subject_id');
    }

    public function submissions(){
      return $this->hasMany('App\Submission','student_subject_id');
    }

    public function supervisors(){
      return $this->hasMany('App\StudentSupervisor','student_subject_id');
    }

    public function examiners(){
      return $this->hasMany('App\StudentExaminer','student_subject_id');
    }

    public function getFunding(){
      return $this->belongsTo('App\Funding');
    }

    public function publications(){
      return $this->hasMany('App\Publication','student_subject_id');
    }
}
