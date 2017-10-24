<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadZone extends BaseModel
{

	protected $fillable = ['CZ_CODE', 'CZ_NAME'];

    public $timestamps = false;

    public function municipality() {

    	return $this->belongsTo('CeadMunicipality');

    }

    public function zoneType() {

    	return $this->belongsTo('CeadZoneType');

    }

    public function zoneLevel() {

    	return $this->belongsTo('CeadZoneLevel');

    }

    public function contactInfos() {

        return $this->hasMany('CeadContactInfo');

    }

    public function numbers() {

        return $this->hasMany('CeadPhoneNumber');

    }

}
