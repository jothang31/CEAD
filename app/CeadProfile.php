<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadProfile extends BaseModel
{
    protected $fillable = ['CP_CODE', 'CP_NAME'];

    public $timestamps = false;

    public function users() {

    	return $this->hasMany('CeadUser');

    }
}
