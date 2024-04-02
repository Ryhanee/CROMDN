<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_mode_exercice extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsToMany('App\Models\Medecin','id','id_type_mode');
    }
}
