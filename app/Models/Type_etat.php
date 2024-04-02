<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_etat extends Model
{
    protected $guarded=[];

    public function etat()
	{
      return $this->belongsToMany('App\Models\Etat','id_type','id');
    }

    public function modes()
    {
      return $this->belongsToMany('App\Models\Mode','mode_types','id_type_etat','id_mode_exercice');
    }

    public function medecin()
    {
     return $this->hasMany('App\Models\Medecin','id','etat_actuel');
   }
}
