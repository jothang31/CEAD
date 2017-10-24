<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadUser extends BaseModel
{
    protected $fillable = [  
    	'CU_CODE',
  		'CU_ID',
  		'CU_PASSWORD',
  		'CU_NAME_PICTURE_PROFILE',
  		'CU_CREATION_DATE',
  		'CU_LAST_ID',
 		  'CU_LAST_PASWORD',
  		'CU_MODIFICATION_DATE',
  		'CP_CODE',
  		'CS_CODE'
  	];

  	public $timestamps = false;
  	

  	public function status() {

  		return $this->belongsTo('CeadStatus');

  	}

  	public function profile() {

  		return $this->belongsTo('CeadProfile');

  	}
}
