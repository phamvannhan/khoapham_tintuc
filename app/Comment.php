<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "Comment";

    public function tintuc()
    {
    	return $this->BelongsTo('App\TinTuc','idTinTuc','id');
    }
    public function users()
    {
    	return $this->BelongsTo('App\User','idUser','id');
    }
}
