<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lettre extends Model
{
    protected $guarded=[];

    public function numeroL()
	{
      return $this->hasMany('App\Models\Numerola','idLettre','id');
    }
}