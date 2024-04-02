<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
	protected $guarded=[];
	
    public function cotisation()
	{
      return $this->belongsTo('App\Models\Cotisation','annee','annee');
    }
}
