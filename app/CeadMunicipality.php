<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadMunicipality extends BaseModel
{
    
	protected $fillable = ['CM_CODE', 'CM_NAME'];

	public $timestamps = false;

	public function zones() {

		return $this->hasMany('CeadZone');

	}

	public function department() {

		return $this->belongsTo('CeadCountryDepartment');

	}

}
