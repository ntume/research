<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExaminer extends Model
{
  protected $fillable = ['student_subject_id','examiner_id'];

  public function getExaminer(){
    return $this->belongsTo('App\Examiner');
  }
}
