<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name', 'code', 'status', 'main', 'created_by', 'modified_by'];

    public function setMainAttribute($value){

    }
    public function setCodeAttribute($value){
        $this->attributes['code'] = strtolower($value);$this->attributes['main'] = 0;
    }
}
