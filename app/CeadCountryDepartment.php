<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadCountryDepartment extends BaseModel
{
    protected $fillable = ['CCD_CODE', 'CCD_NAME'];

    public $timestamps = false;

    public function municipalities() {

    	return $this->hasMany('CeadMunicipality');

    }
}
