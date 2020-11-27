<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataEntries extends Model
{
    protected $fillable = ['projectId',
                           'entryType',
                           'entryDescription',
                           'entryFile',
                           'entryStartDate',
                           'entryEndDate'];

    public function projects(){
        return $this->belongsTo('App\Projects');
    }
}
