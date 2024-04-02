<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsTo('App\Models\Medecin','id','id_medecin');
    }
}
