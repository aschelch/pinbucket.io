<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'url', 'title', 'description', 'user_id', 'team_id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function team()
  {
    return $this->belongsTo(Team::class);
  }
}
