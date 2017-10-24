<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadUserXUser extends BaseModel
{
    protected $fillable = ['CU_CODE', 'CU_LEADER_CODE'];

    public $timestamps = false;
}
