<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminArticle extends Model
{
    //protected $guard = 'admin';
    protected $fillable=['Title', 'Body', 'Picture'];


    public function revealNews()
    {
    	return $this->hasMany(AdminArticle::class);
    }
}
