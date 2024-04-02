<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gouvernorat extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsToMany('App\Models\Medecin','id','id_gouvernorat');
    }
    public function etat()
	{
      return $this->hasMany('App\Models\Etat','id','id_gouvernorat');
    }
}
