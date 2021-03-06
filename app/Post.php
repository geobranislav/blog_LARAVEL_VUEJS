<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','body','image'];

  public function user() {
    return $this->belongsTo('App\User','user_id');
  }

  public function postUser() {
    return $this->hasMany('App\PostUser');
  }


}
