<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medecin extends Model
{
  use SoftDeletes;

    protected $guarded=[];

    public function numeroLA()
    {
      return $this->hasMany('App\Models\Numerola','idMedecin','id');
    }

    public function etat()
	  {
      return $this->hasMany('App\Models\Etat','id_medecin','id');
    }
    
    public function typeEtat()
    {
      return $this->belongsTo('App\Models\Type_etat','etat_actuel','id');
    }

    public function mode()
    {
     return $this->belongsTo('App\Models\Mode','id_mode','id');
    }

    public function type_exercice()
    {
     return $this->belongsTo('App\Models\Type_mode_exercice','id_type_mode','id');
    }

    public function cotisation()
    {
      return $this->hasMany('App\Models\Cotisation','id_medecin','id');
    }
    public function plainte()
    {
      return $this->hasMany('App\Models\Plainte','id_medecin','id');
    }

    public function position()
    {
      return $this->hasOne('App\Models\Position','id_medecin','id');
    }

    public function ville()
    {
      return $this->belongsTo('App\Models\Ville','id_ville','id');
    }
    public function delegation()
    {
      return $this->belongsTo('App\Models\Delegation','id_delegation','id');
    }
    public function gouvernorat()
    {
      return $this->belongsTo('App\Models\Gouvernorat','id_gouvernorat','id');
    }
    public function nationalite()
    {
      return $this->belongsTo('App\Models\Nationalite','id_nationalite','id');
    }

   public function specialite()
    {
      return $this->belongsTo('App\Models\Specialite','id_specialite','id');
    }
    public function diplome()
    {
      return $this->belongsTo('App\Models\Diplome','id_diplome','id');
    }
}
