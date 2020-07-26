<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [ 'name', 'email', 'password', 'api_token', ];

    protected $hidden = [ 'password', 'remember_token', ];

    protected $casts = [ 'email_verified_at' => 'datetime', ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
        
    }
    
    public function electionsVoted()
    {
        return $this->votes->map->election_id->flatten()->unique();
        
    }

    public function booksRated()
    {
        return $this->rates->map->book_id->flatten()->unique();
        
    }
}
