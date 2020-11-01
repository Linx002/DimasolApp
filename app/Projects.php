<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['projectName', 'projectDescription', 'company', 'area', 'requisitedBy', 'startDate', 'endDate', 'consumables'];

    public function dataEntries(){
        return $this->hasMany('App\DataEntries');
    }
}
