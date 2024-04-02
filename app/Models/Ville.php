<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->hasMany('App\Models\Medecin','id','id_ville');
    }

    public function etat()
	{
      return $this->hasMany('App\Models\Etat','id','id_ville');
    }
}
