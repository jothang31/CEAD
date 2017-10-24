<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getTable() 
    {
      return strtoupper(parent::getTable());
    }
}