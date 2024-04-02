<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numerola extends Model
{
    protected $guarded=[];

    public function medecin()
	{
      return $this->belongsTo('App\Models\Medecin','id','idMedecin');
    }

    public function lettre()
	{
      return $this->belongsTo('App\Models\Lettre','id','idLettre');
    }

    public function attestation()
	{
      return $this->belongsTo('App\Models\Attestation','id','idAttestation');
    }

}
