<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadZoneLevel extends BaseModel
{
	protected $fillable = ['CZL_CODE', 'CZL_NAME'];

    public $timestamps = false;

    public function zones() {

    	return $this->hasMany('CeadZone');

    }
}
