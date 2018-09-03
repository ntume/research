<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSupervisor extends Model
{
    //
    protected $fillable = ['student_subject_id','supervisor_id','designation'];

    public function getSupervisor(){
      return $this->belongsTo('App\Supervisors');
    }
}
