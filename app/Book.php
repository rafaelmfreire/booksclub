<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function averageRate()
    {
        // $a = [];
        return collect($this->rates->map->rate->flatten())->avg();

        // $a = array_filter($a);
        // if (count($a)) {
        //     echo $average = array_sum($a) / count($a);
        // }

        // return $average;
    }
}
