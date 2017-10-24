<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadStatus extends BaseModel
{
    protected $fillable = ['CS_CODE', 'CS_NAME'];

    public $timestamps = false;

    public function users() {

    	return $this->hasMany('CeadUser');

    }
}
