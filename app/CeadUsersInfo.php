<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadUsersInfo extends BaseModel
{
    protected $fillable = [
		'CUI_CODE',
		'CUI_FIRST_NAME',
		'CUI_MIDDLE_NAME',
		'CUI_LAST_NAME',
		'CUI_SECOND_SURNAME',
		'CUI_BORN_DATE',
		'CMS_CODE',
		'CG_CODE',
		'CU_CODE' 
    ];

    public $timestamps = false;

    public function maritalStatus() {

    	return $this->belognsTo('CeadMaritalStatus');

    }

    public function gender() {

    	return $this->belognsTo('CeadGender');

    }

    public function user() {

    	return $this->belognsTo('CeadUser');

    }

    public function contactInfos() {

    	return $this->hasMany('CeadContactInfo');

    }
}
