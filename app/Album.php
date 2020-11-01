<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
protected $fillable = ['albumName', 'albumDescription', 'coverPhoto'];

    public function photos(){
        return $this->hasMany('App\Photos');
    }
}
