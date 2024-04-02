<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    protected $guarded=[];

    public function medecin()
	 {
      return $this->hasOne('App\Models\Medecin','id','id_medecin');
    }

    public function typeEtat()
    {
      return $this->hasOne('App\Models\Type_etat','id','id_type');
    }

    public function mode()
   	{
     	return $this->hasOne('App\Models\Mode','id','id_mode_type');
   	}

    public function ville()
    {
      return $this->belongsTo('App\Models\Ville','id_ville','id');
    }
    public function delegation()
    {
      return $this->belongsTo('App\Models\Delegation','id_delegation','id');
    }
    public function gouvernorat()
    {
      return $this->belongsTo('App\Models\Gouvernorat','id_gouvernorat','id');
    }
}
