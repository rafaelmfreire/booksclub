<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $guarded = [];
    protected $dates = ['start_date', 'end_date'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function voters()
    {
        return $this->votes->map->user->flatten()->pluck('name')->unique();
        
    }
}
