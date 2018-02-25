<?php 
use Illuminate\Database\Eloquent\Model;
class User extends Model{
  protected $guarded = [];
  public function posts()
  {
    return $this->hasMany(Post::class);
  }
}