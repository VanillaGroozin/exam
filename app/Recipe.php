<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function User()
    {
        return $this->hasMany('App\User');
    }
    public function Category()
    {
        return $this->hasMany('App\Category');
    }
    public function Ingredient()
    {
        return $this->belongsToMany('App\Ingredient','test2.recipe_ingredients');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($Recipe) { // before delete() method call this
             $Recipe->photos()->delete();
             // do the rest of the cleanup...
        });
    }
}
