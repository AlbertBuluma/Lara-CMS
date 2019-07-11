<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; //Permit mass assignment of name field

    public function posts(){

        return $this->hasMany(Post::class); //A category may have many posts
    }
}
