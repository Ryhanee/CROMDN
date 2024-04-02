<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsToMany('App\Models\Medecin','id','id_exercice');
    }
}
