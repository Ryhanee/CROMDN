<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    protected $guarded=[];

    public function numeroL()
	{
     	return $this->hasMany('App\Models\Numerola','idAttestation','id');
    }
}
