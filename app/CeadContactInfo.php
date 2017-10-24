<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadContactInfo extends BaseModel
{
    protected $fillable = [
    	'CCI_CODE',
		'CCI_EMAIL',
	  	'CCI_ADDRESS',
	  	'CZ_CODE',
	 	'CUI_CODE',
	  	'CCIT_CODE'
	];

	public $timestamps = false;

	public function usersInfo() {

		return $this->belongsTo('CeadUsersInfo');

	}

    public function zone() {

    	return $this->belongsTo('CeadZone');

    }
}
