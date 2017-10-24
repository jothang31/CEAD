<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadPhoneNumber extends BaseModel
{
    protected $fillable = ['CPN_NUMBER', 'CCI_CODE'];

    public $timestamps = false;

    public function contatInfo() {

    	return $this->belongsTo('CeadContactInfo');

    }
}
