<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CeadGroupXGroup extends BaseModel
{
    protected $fillable = ['CU_CODE', 'CU_PARENT_CODE'];

    public $timestamps = false;
}
