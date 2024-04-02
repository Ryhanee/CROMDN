<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
	//mode exercice
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsToMany('App\Models\Medecin','id','id_mode');
    }

    public function mode_type()
	{
      return $this->belongsTo('App\Models\Mode_type','id_mode','id');
    }
    public function type_etats()
    {
      return $this->belongsToMany('App\Models\Type_etat','mode_types','id_mode_exercice','id_type_etat');
    }

    public function etat()
  	{
      return $this->belongsToMany('App\Models\Etat','id','id_mode_type');
    }
}
