<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'owner_id'
    ];

    public function owner()
    {
      return $this->belongsTo(User::class, 'owner_id');
    }

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    public function links(){
      return $this->hasMany(Link::class);
    }
}
