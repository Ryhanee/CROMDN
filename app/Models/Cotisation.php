<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsTo('App\Models\Medecin','id','id_medecin');
    }

    public function tarif()
	{
      return $this->belongsTo('App\Models\Tarif','annee','annee');
    }
}
