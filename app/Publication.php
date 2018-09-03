<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
  protected $fillable = ['student_subject_id','title','type','name','conference_date'];

  public function student(){
    return $this->belongsTo('App\Student_Subject');
  }
}
