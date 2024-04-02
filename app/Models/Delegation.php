<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsToMany('App\Models\Medecin','id','id_delegation');
    }
    public function etat()
	{
      return $this->hasMany('App\Models\Etat','id','id_delegation');
    }
}
