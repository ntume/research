<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        'student_number', 'id_number', 'fullname','gender','race','email','department_id','contact'
    ];

    public function department(){
      return $this->belongsTo('App\Department');
    }

    public function subjects(){
      return $this->belongsToMany('App\Subject','student_subjects')
                  ->withPivot('id','registration_date', 'submit_date','submitted','average_grade','completed','funding_id')
                	->withTimestamps();
    }

    public function getSupervisors(){
      return $this->hasManyThrough('App\Supervisors','App\Student_Supervisor');
    }

    public function getSubmissions(){
      return $this->hasManyThrough('App\Submission','App\Student_Subject');
    }

    public function getExaminers(){
      return $this->hasManyThrough('App\Examiners','App\StudentExaminer');
    }

}
