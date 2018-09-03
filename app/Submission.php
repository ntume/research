<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    //
    protected $fillable = ['student_subject_id','name','description','submission_date','filepath','submission_types_id'];

    public function student_subject(){
      return $this->belogsTo('App\Student_Subject');
    }

    public function getType(){
      return $this->belongsTo('App\SubmissionType');
    }
}
