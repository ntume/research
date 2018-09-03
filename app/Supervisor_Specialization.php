<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor_Specialization extends Model
{
    //
    protected $fillable = [
      'supervisor_id','specialization_id',
    ];

    public function supervisor(){
      return $this->belongsTo('App\Supervisor');
    }

    public function specialization(){
      return $this->belongsTo('App\Specialization');
    }
}
