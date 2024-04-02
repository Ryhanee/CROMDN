<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plainte extends Model
{
	use SoftDeletes;

    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsTo('App\Models\Medecin','id','id_medecin');
    }

    public function motif()
    {
      return $this->belongsTo('App\Models\Motif','id_motif','id');
    }
}
