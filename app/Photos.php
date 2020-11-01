<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $fillable = array('albumId', 'photoDescription', 'photoTitle', 'photoSize');

    public function album(){
        return $this->belongsTo('App\Album');
    }
}
