<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    protected $guarded=[];

    public function plainte()
	{
      return $this->belongsToMany('App\Models\Plainte','id','id_plainte');
    }
}
