<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadZoneType extends BaseModel
{

	protected $fillable = ['CZT_CODE', 'CZT_NAME'];

    public $timestamps = false;

    public function zones() {

    	return $this->hasMany('CeadZone');

    }
}
