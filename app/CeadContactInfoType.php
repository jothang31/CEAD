<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadContactInfoType extends BaseModel
{
    protected $fillable = ['CCIT_CODE', 'CCIT_NAME'];

    public $timestamps = false;

    public function contactInfos() {

    	return $this->hasMany('CeadContactInfos');

    }
}
