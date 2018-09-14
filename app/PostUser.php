<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
  protected $table = 'post_user';

  public function users()
  {
    return $this->belongsTo('\App\User');
  }

  public function posts()
  {
    return $this->belongsTo('\App\Post');
  }

  public static function getLikedPostUser($postId){
    return self::where('post_id', $postId)->with('users')->get();
  }
}
