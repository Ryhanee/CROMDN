<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_sanction extends Model
{
    protected $guarded=[];

    public function discipline()
	{
      return $this->belongsToMany('App\Models\Discipline','id_sanction','id');
    }
}
