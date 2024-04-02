<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $guarded=[];
    
     public function sanctions()
    {
      return $this->hasOne('App\Models\Type_sanction','id','id_sanction');
    }
}
